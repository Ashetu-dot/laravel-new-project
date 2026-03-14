/**
 * Cart functionality for Vendora
 * Handles adding products to cart, updating quantities, and cart operations
 */

// Add product to cart
function addToCart(productId, quantity = 1, options = {}) {
  // Check if user is authenticated
  const isAuthenticated = document.querySelector('meta[name="user-authenticated"]')?.content === 'true';

  if (!isAuthenticated) {
    window.location.href = '/login';
    return;
  }

  const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;

  if (!csrfToken) {
    console.error('CSRF token not found');
    showCartNotification('Error', 'Security token missing. Please refresh the page.', 'error');
    return;
  }

  // Show loading state if button exists
  const button = event?.target?.closest('button');
  let originalButtonContent = '';

  if (button) {
    originalButtonContent = button.innerHTML;
    button.disabled = true;
    button.innerHTML = '<i class="ri-loader-4-line" style="animation: spin 1s linear infinite;"></i> Adding...';
  }

  fetch(`/customer/cart/add/${productId}`, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': csrfToken,
      'Accept': 'application/json'
    },
    body: JSON.stringify({
      quantity: parseInt(quantity),
      options: options
    })
  })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        // Update button state
        if (button) {
          button.innerHTML = '<i class="ri-check-line"></i> Added!';
          button.style.background = '#10b981';

          setTimeout(() => {
            button.innerHTML = originalButtonContent;
            button.disabled = false;
            button.style.background = '';
          }, 2000);
        }

        // Show success notification
        showCartNotification('Success', data.message || 'Product added to cart!', 'success');

        // Update cart count
        updateCartCount();
      } else {
        if (button) {
          button.innerHTML = originalButtonContent;
          button.disabled = false;
        }
        showCartNotification('Error', data.message || 'Failed to add to cart', 'error');
      }
    })
    .catch(error => {
      console.error('Error:', error);
      if (button) {
        button.innerHTML = originalButtonContent;
        button.disabled = false;
      }
      showCartNotification('Error', 'An error occurred while adding to cart', 'error');
    });
}

// Quick add to cart (for product cards)
function quickAddToCart(productId, event) {
  if (event) {
    event.preventDefault();
    event.stopPropagation();
  }
  addToCart(productId, 1, {});
}

// Update cart count badge
function updateCartCount() {
  fetch('/customer/cart/count', {
    headers: {
      'Accept': 'application/json'
    }
  })
    .then(response => response.json())
    .then(data => {
      const cartBadges = document.querySelectorAll('.cart-count, .cart-badge, [data-cart-count]');
      cartBadges.forEach(badge => {
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
    .catch(error => console.error('Error updating cart count:', error));
}

// Show cart notification
function showCartNotification(title, message, type = 'info') {
  // Remove existing notifications
  const existing = document.querySelectorAll('.cart-notification');
  existing.forEach(n => n.remove());

  // Create notification element
  const notification = document.createElement('div');
  notification.className = 'cart-notification';
  notification.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        background: ${type === 'success' ? '#10b981' : type === 'error' ? '#ef4444' : '#3b82f6'};
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
    info: 'information-line'
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

// Quantity controls for product page
function increaseQuantity(inputId = 'quantity') {
  const input = document.getElementById(inputId);
  if (!input) return;

  const max = parseInt(input.max) || 999;
  const current = parseInt(input.value) || 1;

  if (current < max) {
    input.value = current + 1;
  }
}

function decreaseQuantity(inputId = 'quantity') {
  const input = document.getElementById(inputId);
  if (!input) return;

  const min = parseInt(input.min) || 1;
  const current = parseInt(input.value) || 1;

  if (current > min) {
    input.value = current - 1;
  }
}

// Add CSS animations if not already present
if (!document.getElementById('cart-animations')) {
  const style = document.createElement('style');
  style.id = 'cart-animations';
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
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
    `;
  document.head.appendChild(style);
}

// Initialize cart count on page load
document.addEventListener('DOMContentLoaded', function () {
  const isAuthenticated = document.querySelector('meta[name="user-authenticated"]')?.content === 'true';
  if (isAuthenticated) {
    updateCartCount();
  }
});
