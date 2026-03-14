/**
 * Wishlist functionality for Vendora
 * Handles adding/removing products from wishlist
 */

// Add product to wishlist
function addToWishlist(productId, event) {
  if (event) {
    event.preventDefault();
    event.stopPropagation();
  }

  // Check if user is authenticated
  const isAuthenticated = document.querySelector('meta[name="user-authenticated"]')?.content === 'true';

  if (!isAuthenticated) {
    window.location.href = '/login';
    return;
  }

  const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;

  if (!csrfToken) {
    console.error('CSRF token not found');
    showWishlistNotification('Error', 'Security token missing. Please refresh the page.', 'error');
    return;
  }

  // Show loading state if button exists
  const button = event?.target?.closest('button');
  let originalButtonContent = '';

  if (button) {
    originalButtonContent = button.innerHTML;
    button.disabled = true;
    button.innerHTML = '<i class="ri-loader-4-line" style="animation: spin 1s linear infinite;"></i>';
  }

  fetch(`/customer/wishlist/add/${productId}`, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': csrfToken,
      'Accept': 'application/json'
    }
  })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        // Update button state
        if (button) {
          button.innerHTML = '<i class="ri-heart-fill"></i>';
          button.style.color = '#ef4444';
          button.onclick = () => removeFromWishlist(productId, event);
        }

        // Show success notification
        showWishlistNotification('Success', data.message || 'Product added to wishlist!', 'success');

        // Update wishlist count
        updateWishlistCount();
      } else {
        if (button) {
          button.innerHTML = originalButtonContent;
          button.disabled = false;
        }
        showWishlistNotification('Info', data.message || 'Product already in wishlist', 'info');
      }
    })
    .catch(error => {
      console.error('Error:', error);
      if (button) {
        button.innerHTML = originalButtonContent;
        button.disabled = false;
      }
      showWishlistNotification('Error', 'An error occurred while adding to wishlist', 'error');
    });
}

// Remove product from wishlist
function removeFromWishlist(productId, event) {
  if (event) {
    event.preventDefault();
    event.stopPropagation();
  }

  const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
  const button = event?.target?.closest('button');
  let originalButtonContent = '';

  if (button) {
    originalButtonContent = button.innerHTML;
    button.disabled = true;
    button.innerHTML = '<i class="ri-loader-4-line" style="animation: spin 1s linear infinite;"></i>';
  }

  fetch(`/customer/wishlist/remove/${productId}`, {
    method: 'DELETE',
    headers: {
      'X-CSRF-TOKEN': csrfToken,
      'Accept': 'application/json'
    }
  })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        // Update button state
        if (button) {
          button.innerHTML = '<i class="ri-heart-line"></i>';
          button.style.color = '';
          button.onclick = () => addToWishlist(productId, event);
          button.disabled = false;
        }

        // Show success notification
        showWishlistNotification('Success', data.message || 'Product removed from wishlist!', 'success');

        // Update wishlist count
        updateWishlistCount();

        // If on wishlist page, remove the item from view
        const itemElement = document.getElementById(`wishlist-item-${productId}`);
        if (itemElement) {
          itemElement.style.animation = 'fadeOut 0.3s ease';
          setTimeout(() => itemElement.remove(), 300);
        }
      } else {
        if (button) {
          button.innerHTML = originalButtonContent;
          button.disabled = false;
        }
        showWishlistNotification('Error', data.message || 'Failed to remove from wishlist', 'error');
      }
    })
    .catch(error => {
      console.error('Error:', error);
      if (button) {
        button.innerHTML = originalButtonContent;
        button.disabled = false;
      }
      showWishlistNotification('Error', 'An error occurred while removing from wishlist', 'error');
    });
}

// Toggle wishlist (add if not in wishlist, remove if in wishlist)
function toggleWishlist(productId, event) {
  if (event) {
    event.preventDefault();
    event.stopPropagation();
  }

  const button = event?.target?.closest('button');
  const icon = button?.querySelector('i');

  // Check if already in wishlist based on icon
  if (icon && icon.classList.contains('ri-heart-fill')) {
    removeFromWishlist(productId, event);
  } else {
    addToWishlist(productId, event);
  }
}

// Update wishlist count badge
function updateWishlistCount() {
  fetch('/customer/wishlist/count', {
    headers: {
      'Accept': 'application/json'
    }
  })
    .then(response => response.json())
    .then(data => {
      const wishlistBadges = document.querySelectorAll('.wishlist-count, .wishlist-badge, [data-wishlist-count]');
      wishlistBadges.forEach(badge => {
        if (data.count !== undefined) {
          badge.textContent = data.count;
          if (data.count > 0) {
            badge.style.display = 'flex';
          } else {
            badge.style.display = 'none';
          }
        }
      });
    })
    .catch(error => console.error('Error updating wishlist count:', error));
}

// Check if product is in wishlist
function checkWishlistStatus(productId) {
  return fetch(`/customer/wishlist/check/${productId}`, {
    headers: {
      'Accept': 'application/json'
    }
  })
    .then(response => response.json())
    .then(data => data.in_wishlist)
    .catch(error => {
      console.error('Error checking wishlist:', error);
      return false;
    });
}

// Show wishlist notification
function showWishlistNotification(title, message, type = 'info') {
  // Remove existing notifications
  const existing = document.querySelectorAll('.wishlist-notification');
  existing.forEach(n => n.remove());

  // Create notification element
  const notification = document.createElement('div');
  notification.className = 'wishlist-notification';
  notification.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        background: ${type === 'success' ? '#10b981' : type === 'error' ? '#ef4444' : type === 'info' ? '#3b82f6' : '#f59e0b'};
        color: white;
        padding: 16px 24px;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        z-index: 10000;
        display: flex;
        align-items: center;
        gap: 12px;
        max-width: 400px;
        animation: slideInRight 0.3s ease;
    `;

  const iconMap = {
    success: 'check-line',
    error: 'error-warning-line',
    info: 'information-line',
    warning: 'alert-line'
  };

  notification.innerHTML = `
        <i class="ri-${iconMap[type] || 'information-line'}" style="font-size: 24px;"></i>
        <div>
            <div style="font-weight: 600; margin-bottom: 4px;">${title}</div>
            <div style="font-size: 14px; opacity: 0.9;">${message}</div>
        </div>
        <button onclick="this.parentElement.remove()" style="background: none; border: none; color: white; cursor: pointer; padding: 4px; margin-left: 8px;">
            <i class="ri-close-line" style="font-size: 20px;"></i>
        </button>
    `;

  document.body.appendChild(notification);

  // Auto remove after 4 seconds
  setTimeout(() => {
    notification.style.animation = 'slideOutRight 0.3s ease';
    setTimeout(() => notification.remove(), 300);
  }, 4000);
}

// Add CSS animations if not already present
if (!document.getElementById('wishlist-animations')) {
  const style = document.createElement('style');
  style.id = 'wishlist-animations';
  style.textContent = `
        @keyframes slideInRight {
            from {
                transform: translateX(400px);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
        @keyframes slideOutRight {
            from {
                transform: translateX(0);
                opacity: 1;
            }
            to {
                transform: translateX(400px);
                opacity: 0;
            }
        }
        @keyframes fadeOut {
            from {
                opacity: 1;
                transform: scale(1);
            }
            to {
                opacity: 0;
                transform: scale(0.9);
            }
        }
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
    `;
  document.head.appendChild(style);
}

// Initialize wishlist count on page load
document.addEventListener('DOMContentLoaded', function () {
  const isAuthenticated = document.querySelector('meta[name="user-authenticated"]')?.content === 'true';
  if (isAuthenticated) {
    updateWishlistCount();
  }
});
