<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Vendora Admin Documentation</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 40px;
        }
        h1 {
            color: #B88E3F;
            border-bottom: 2px solid #B88E3F;
            padding-bottom: 10px;
            font-size: 28px;
        }
        h2 {
            color: #1f2937;
            margin-top: 30px;
            border-bottom: 1px solid #e5e7eb;
            padding-bottom: 8px;
            font-size: 22px;
        }
        h3 {
            color: #4b5563;
            margin-top: 20px;
            font-size: 18px;
        }
        h4 {
            color: #6b7280;
            margin-top: 15px;
            font-size: 16px;
        }
        .header {
            text-align: center;
            margin-bottom: 40px;
            padding-bottom: 20px;
            border-bottom: 1px solid #e5e7eb;
        }
        .logo {
            font-size: 32px;
            font-weight: bold;
            color: #B88E3F;
            margin-bottom: 10px;
        }
        .logo i {
            font-style: normal;
            background: linear-gradient(135deg, #078930 0%, #FCDD09 50%, #DA121A 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-size: 14px;
            display: inline-block;
            margin-left: 10px;
        }
        .version {
            color: #6b7280;
            font-size: 14px;
            margin-top: 5px;
        }
        .last-updated {
            color: #6b7280;
            font-size: 12px;
            margin-top: 5px;
        }
        .section {
            margin-bottom: 30px;
        }
        .tip {
            background-color: #fef3e7;
            border-left: 4px solid #B88E3F;
            padding: 15px 20px;
            margin: 20px 0;
            border-radius: 0 8px 8px 0;
        }
        .warning {
            background-color: #fff7ed;
            border-left: 4px solid #f59e0b;
            padding: 15px 20px;
            margin: 20px 0;
            border-radius: 0 8px 8px 0;
        }
        .info {
            background-color: #e6f7ff;
            border-left: 4px solid #1890ff;
            padding: 15px 20px;
            margin: 20px 0;
            border-radius: 0 8px 8px 0;
        }
        .success {
            background-color: #f0f9eb;
            border-left: 4px solid #52c41a;
            padding: 15px 20px;
            margin: 20px 0;
            border-radius: 0 8px 8px 0;
        }
        code {
            background-color: #f3f4f6;
            padding: 2px 6px;
            border-radius: 4px;
            font-family: monospace;
            font-size: 13px;
            color: #d14;
        }
        pre {
            background-color: #1e293b;
            color: #e2e8f0;
            padding: 15px;
            border-radius: 8px;
            overflow-x: auto;
            font-family: monospace;
            font-size: 13px;
            line-height: 1.5;
            margin: 15px 0;
        }
        pre code {
            background-color: transparent;
            color: inherit;
            padding: 0;
        }
        ul, ol {
            margin: 10px 0 10px 25px;
        }
        li {
            margin-bottom: 5px;
        }
        .page-break {
            page-break-after: always;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 14px;
        }
        th {
            background-color: #f3f4f6;
            padding: 12px;
            text-align: left;
            border: 1px solid #e5e7eb;
            font-weight: 600;
        }
        td {
            padding: 10px 12px;
            border: 1px solid #e5e7eb;
        }
        tr:nth-child(even) {
            background-color: #f9fafb;
        }
        .badge {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 500;
        }
        .badge-pending {
            background-color: #fff7ed;
            color: #9a3412;
        }
        .badge-approved {
            background-color: #f0f9eb;
            color: #166534;
        }
        .badge-rejected {
            background-color: #fef2f2;
            color: #991b1b;
        }
        .footer {
            text-align: center;
            margin-top: 50px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
            color: #6b7280;
            font-size: 12px;
        }
        .footer p {
            margin: 5px 0;
        }
        .table-of-contents {
            margin: 30px 0;
            padding: 20px;
            background-color: #f9fafb;
            border-radius: 8px;
        }
        .table-of-contents ul {
            list-style-type: none;
            margin-left: 0;
        }
        .table-of-contents li {
            margin-bottom: 8px;
        }
        .table-of-contents a {
            color: #B88E3F;
            text-decoration: none;
        }
        .table-of-contents a:hover {
            text-decoration: underline;
        }
        .stat-card {
            display: inline-block;
            width: 23%;
            margin: 1%;
            padding: 15px;
            background-color: #f9fafb;
            border-radius: 8px;
            text-align: center;
            border: 1px solid #e5e7eb;
        }
        .stat-value {
            font-size: 24px;
            font-weight: bold;
            color: #B88E3F;
        }
        .stat-label {
            font-size: 12px;
            color: #6b7280;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="logo">
            Vendora <i>🇪🇹 Jimma, Ethiopia</i>
        </div>
        <h1>Admin Documentation</h1>
        <div class="version">Version {{ $version ?? '2.1.0' }}</div>
        <div class="last-updated">Last Updated: {{ $lastUpdated ?? now()->format('F j, Y') }}</div>
    </div>

    <!-- Table of Contents -->
    <div class="table-of-contents">
        <h3 style="margin-top: 0;">Table of Contents</h3>
        <ul>
            <li><a href="#getting-started">1. Getting Started</a></li>
            <li><a href="#dashboard">2. Dashboard Overview</a></li>
            <li><a href="#orders">3. Orders Management</a></li>
            <li><a href="#customers">4. Customer Management</a></li>
            <li><a href="#vendors">5. Vendor Management</a></li>
            <li><a href="#products">6. Product Management</a></li>
            <li><a href="#categories">7. Categories</a></li>
            <li><a href="#marketing">8. Marketing Tools</a></li>
            <li><a href="#analytics">9. Analytics & Reports</a></li>
            <li><a href="#settings">10. System Settings</a></li>
            <li><a href="#faq">11. Frequently Asked Questions</a></li>
            <li><a href="#troubleshooting">12. Troubleshooting</a></li>
        </ul>
    </div>

    <!-- Getting Started Section -->
    <div class="section" id="getting-started">
        <h2>1. Getting Started</h2>
        <p>Welcome to the Vendora admin documentation. This comprehensive guide will help you manage your marketplace effectively and efficiently.</p>
        
        <div class="tip">
            <strong>🚀 Quick Start Guide:</strong>
            <ul>
                <li><strong>Step 1:</strong> Log in to your admin account at <code>/admin/login</code></li>
                <li><strong>Step 2:</strong> Review your dashboard for key metrics and alerts</li>
                <li><strong>Step 3:</strong> Check pending vendor applications in the Vendors section</li>
                <li><strong>Step 4:</strong> Monitor new orders in the Orders section</li>
                <li><strong>Step 5:</strong> Configure marketplace settings in System Settings</li>
            </ul>
        </div>

        <h3>Admin Access Levels</h3>
        <table>
            <thead>
                <tr>
                    <th>Role</th>
                    <th>Permissions</th>
                    <th>Access Level</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>Super Admin</strong></td>
                    <td>Full system access, user management, settings configuration</td>
                    <td><span class="badge badge-approved">Full Access</span></td>
                </tr>
                <tr>
                    <td><strong>Orders Manager</strong></td>
                    <td>Manage orders, process refunds, handle customer issues</td>
                    <td><span class="badge badge-pending">Limited</span></td>
                </tr>
                <tr>
                    <td><strong>Content Manager</strong></td>
                    <td>Manage products, categories, promotions, reviews</td>
                    <td><span class="badge badge-pending">Limited</span></td>
                </tr>
                <tr>
                    <td><strong>Support Agent</strong></td>
                    <td>View orders, respond to customer messages, view basic reports</td>
                    <td><span class="badge badge-pending">Read-only</span></td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Dashboard Section -->
    <div class="section" id="dashboard">
        <h2>2. Dashboard Overview</h2>
        <p>The admin dashboard provides a real-time overview of your marketplace performance with key metrics and visual data.</p>

        <h3>Key Metrics Cards</h3>
        <div style="display: flex; flex-wrap: wrap; margin: 20px -1%;">
            <div class="stat-card">
                <div class="stat-value">ETB 245.8K</div>
                <div class="stat-label">Total Revenue</div>
            </div>
            <div class="stat-card">
                <div class="stat-value">1,247</div>
                <div class="stat-label">Total Orders</div>
            </div>
            <div class="stat-card">
                <div class="stat-value">3,892</div>
                <div class="stat-label">Total Users</div>
            </div>
            <div class="stat-card">
                <div class="stat-value">456</div>
                <div class="stat-label">Total Products</div>
            </div>
        </div>

        <h3>Dashboard Components</h3>
        <ul>
            <li><strong>Sales Chart:</strong> Visual representation of daily/weekly/monthly sales trends</li>
            <li><strong>Recent Orders:</strong> List of the 10 most recent orders with quick actions</li>
            <li><strong>Top Products:</strong> Best-selling products with revenue and quantity</li>
            <li><strong>User Activity:</strong> New registrations and active users</li>
            <li><strong>Pending Actions:</strong> Quick links to pending approvals (vendors, products, reviews)</li>
        </ul>

        <div class="info">
            <strong>💡 Tip:</strong> Use the date range selector to view data for different periods (Today, Week, Month, Year, Custom).
        </div>
    </div>

    <!-- Orders Management Section -->
    <div class="section" id="orders">
        <h2>3. Orders Management</h2>
        
        <h3>Order Statuses</h3>
        <table>
            <thead>
                <tr>
                    <th>Status</th>
                    <th>Description</th>
                    <th>Next Steps</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><span class="badge badge-pending">Pending</span></td>
                    <td>Order received, waiting for payment confirmation</td>
                    <td>Verify payment, update to processing</td>
                </tr>
                <tr>
                    <td><span class="badge badge-pending">Processing</span></td>
                    <td>Payment confirmed, order being prepared</td>
                    <td>Prepare items, update to shipped</td>
                </tr>
                <tr>
                    <td><span class="badge badge-approved">Shipped</span></td>
                    <td>Order has been shipped to customer</td>
                    <td>Add tracking info, update to delivered</td>
                </tr>
                <tr>
                    <td><span class="badge badge-approved">Delivered</span></td>
                    <td>Order delivered to customer</td>
                    <td>Mark as complete, revenue recorded</td>
                </tr>
                <tr>
                    <td><span class="badge badge-rejected">Cancelled</span></td>
                    <td>Order cancelled by customer or admin</td>
                    <td>Process refund if payment was made</td>
                </tr>
                <tr>
                    <td><span class="badge badge-rejected">Refunded</span></td>
                    <td>Order refunded to customer</td>
                    <td>Update inventory, close order</td>
                </tr>
            </tbody>
        </table>

        <div class="warning">
            <strong>⚠️ Important:</strong> Always verify payment status before updating orders to "completed" status. Check payment gateway logs if needed.
        </div>

        <h3>Processing Refunds</h3>
        <ol>
            <li>Navigate to the order details page</li>
            <li>Click the "Process Refund" button</li>
            <li>Select which items to refund (full or partial)</li>
            <li>Enter the refund amount</li>
            <li>Select refund reason from dropdown</li>
            <li>Add optional notes about the refund</li>
            <li>Click "Confirm Refund" to process</li>
        </ol>

        <h3>Bulk Order Operations</h3>
        <ul>
            <li><strong>Bulk Status Update:</strong> Select multiple orders and update status simultaneously</li>
            <li><strong>Export Orders:</strong> Export orders to CSV with applied filters</li>
            <li><strong>Print Invoices:</strong> Generate PDF invoices for selected orders</li>
        </ul>

        <h3>Order Filters</h3>
        <ul>
            <li>By status (pending, processing, completed, etc.)</li>
            <li>By date range (custom date picker)</li>
            <li>By customer name or email</li>
            <li>By product</li>
            <li>By payment method</li>
            <li>By order total range</li>
        </ul>

        <pre><code>// Example API endpoint for orders
GET /api/admin/orders?status=pending&date_from=2024-01-01&date_to=2024-01-31</code></pre>
    </div>

    <!-- Customer Management Section -->
    <div class="section" id="customers">
        <h2>4. Customer Management</h2>

        <h3>Customer Overview</h3>
        <p>The Customers section provides a complete view of all registered customers with their activity and purchase history.</p>

        <h3>Customer Details Page</h3>
        <ul>
            <li><strong>Profile Information:</strong> Name, email, phone, address, registration date</li>
            <li><strong>Order History:</strong> Complete list of customer's orders with status</li>
            <li><strong>Wishlist:</strong> Products saved by the customer</li>
            <li><strong>Reviews:</strong> All reviews written by the customer</li>
            <li><strong>Activity Log:</strong> Login history and actions</li>
        </ul>

        <h3>Customer Actions</h3>
        <ul>
            <li><strong>Edit Customer:</strong> Update customer information</li>
            <li><strong>Change Password:</strong> Reset customer password (sends email notification)</li>
            <li><strong>Suspend Account:</strong> Temporarily disable customer access</li>
            <li><strong>Delete Account:</strong> Permanently remove customer (with confirmation)</li>
            <li><strong>Send Message:</strong> Contact customer via internal messaging</li>
        </ul>

        <div class="tip">
            <strong>📧 Customer Communication:</strong> Use the messaging system to communicate with customers. All messages are stored and can be viewed in the conversation history.
        </div>
    </div>

    <!-- Vendor Management Section -->
    <div class="section" id="vendors">
        <h2>5. Vendor Management</h2>

        <h3>Vendor Approval Process</h3>
        <ol>
            <li>Go to Vendors page and filter by "Pending" status</li>
            <li>Review vendor application details:
                <ul>
                    <li>Business name and description</li>
                    <li>Contact information (phone, email)</li>
                    <li>Business category</li>
                    <li>Tax ID / Business license</li>
                    <li>Bank account details for payouts</li>
                </ul>
            </li>
            <li>Verify submitted documents (if applicable)</li>
            <li>Click "Verify" to approve or "Reject" with reason</li>
        </ol>

        <div class="success">
            <strong>✅ Approved Vendors:</strong> Can immediately start adding products and receiving orders. Their store becomes visible to customers.
        </div>

        <h3>Vendor Verification Checklist</h3>
        <table>
            <thead>
                <tr>
                    <th>Document</th>
                    <th>Verification Steps</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Business License</td>
                    <td>Check validity and expiration date</td>
                    <td><span class="badge badge-pending">Required</span></td>
                </tr>
                <tr>
                    <td>Tax ID</td>
                    <td>Verify format and uniqueness</td>
                    <td><span class="badge badge-pending">Required</span></td>
                </tr>
                <tr>
                    <td>Phone Number</td>
                    <td>Send verification code</td>
                    <td><span class="badge badge-pending">Required</span></td>
                </tr>
                <tr>
                    <td>Bank Account</td>
                    <td>Verify account holder name matches</td>
                    <td><span class="badge badge-pending">Required</span></td>
                </tr>
            </tbody>
        </table>

        <h3>Vendor Payouts</h3>
        <ol>
            <li>Navigate to Vendors → Payouts</li>
            <li>View pending payouts with amounts</li>
            <li>Select vendors for bulk payout</li>
            <li>Review payout summary</li>
            <li>Click "Process Payouts" to initiate</li>
            <li>System will update payout status automatically</li>
        </ol>

        <h3>Vendor Suspension</h3>
        <p>If a vendor violates terms of service:</p>
        <ol>
            <li>Go to vendor details page</li>
            <li>Click "Suspend Vendor"</li>
            <li>Select reason from dropdown:
                <ul>
                    <li>Terms of service violation</li>
                    <li>Fraudulent activity</li>
                    <li>Poor customer service</li>
                    <li>Inactive for 30+ days</li>
                    <li>Other (custom reason)</li>
                </ul>
            </li>
            <li>Set suspension duration (temporary or permanent)</li>
            <li>Add notes (internal use only)</li>
            <li>Confirm suspension</li>
        </ol>
    </div>

    <!-- Product Management Section -->
    <div class="section" id="products">
        <h2>6. Product Management</h2>

        <h3>Product Approval Workflow</h3>
        <ol>
            <li>Go to Products page and filter by "Pending" status</li>
            <li>Review product details:
                <ul>
                    <li>Product name and description</li>
                    <li>Price and stock quantity</li>
                    <li>Images (minimum 2, maximum 8)</li>
                    <li>Category assignment</li>
                    <li>Tags and attributes</li>
                </ul>
            </li>
            <li>Check image quality and relevance</li>
            <li>Verify pricing is appropriate</li>
            <li>Approve or reject with reason</li>
        </ol>

        <h3>Bulk Product Operations</h3>
        <ul>
            <li><strong>Bulk Approve:</strong> Approve multiple pending products</li>
            <li><strong>Bulk Delete:</strong> Remove multiple products</li>
            <li><strong>Bulk Category Update:</strong> Change category for selected products</li>
            <li><strong>Export Products:</strong> Download product list as CSV</li>
        </ul>

        <h3>Inventory Management</h3>
        <ul>
            <li><strong>Low Stock Alerts:</strong> Products with stock below threshold (default: 5)</li>
            <li><strong>Out of Stock:</strong> Products with zero inventory</li>
            <li><strong>Restock:</strong> Update stock quantities</li>
            <li><strong>Inventory Report:</strong> Export inventory status</li>
        </ul>

        <div class="warning">
            <strong>⚠️ Note:</strong> Low stock alerts are sent daily to vendors. Admins can also view low stock products in the dashboard.
        </div>
    </div>

    <!-- Categories Section -->
    <div class="section" id="categories">
        <h2>7. Categories</h2>

        <h3>Category Management</h3>
        <ul>
            <li><strong>Create Category:</strong> Add new product categories</li>
            <li><strong>Edit Category:</strong> Update name, description, image</li>
            <li><strong>Delete Category:</strong> Remove unused categories</li>
            <li><strong>Reorder Categories:</strong> Drag and drop to set display order</li>
        </ul>

        <h3>Category Fields</h3>
        <table>
            <thead>
                <tr>
                    <th>Field</th>
                    <th>Description</th>
                    <th>Required</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Name</td>
                    <td>Category display name</td>
                    <td>Yes</td>
                </tr>
                <tr>
                    <td>Slug</td>
                    <td>URL-friendly version of name (auto-generated)</td>
                    <td>Yes</td>
                </tr>
                <tr>
                    <td>Description</td>
                    <td>Brief description of the category</td>
                    <td>No</td>
                </tr>
                <tr>
                    <td>Image</td>
                    <td>Category icon or banner image</td>
                    <td>No</td>
                </tr>
                <tr>
                    <td>Parent Category</td>
                    <td>For hierarchical categories</td>
                    <td>No</td>
                </tr>
                <tr>
                    <td>Sort Order</td>
                    <td>Display priority (lower numbers first)</td>
                    <td>No</td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Marketing Tools Section -->
    <div class="section" id="marketing">
        <h2>8. Marketing Tools</h2>

        <h3>Promotions</h3>
        <p>Create and manage sales promotions:</p>
        <ol>
            <li>Go to Promotions page</li>
            <li>Click "Create Promotion"</li>
            <li>Select promotion type:
                <ul>
                    <li><strong>Percentage Discount:</strong> e.g., 20% off</li>
                    <li><strong>Fixed Amount:</strong> e.g., ETB 500 off</li>
                    <li><strong>Buy X Get Y:</strong> e.g., Buy 2 get 1 free</li>
                </ul>
            </li>
            <li>Select applicable products or categories</li>
            <li>Set minimum purchase amount (optional)</li>
            <li>Set start and end dates</li>
            <li>Add promotion banner/image (optional)</li>
            <li>Publish promotion</li>
        </ol>

        <h3>Coupon Management</h3>
        <ul>
            <li><strong>Generate Coupons:</strong> Create unique or bulk coupon codes</li>
            <li><strong>Set Discount:</strong> Percentage or fixed amount</li>
            <li><strong>Usage Limits:</strong> Per user and total usage</li>
            <li><strong>Expiration:</strong> Set validity period</li>
            <li><strong>Track Usage:</strong> View redemption statistics</li>
        </ul>

        <pre><code>// Example coupon code format
SUMMER2024-XXXX-XXXX-XXXX</code></pre>

        <h3>Email Campaigns</h3>
        <ul>
            <li><strong>Templates:</strong> Create reusable email templates</li>
            <li><strong>Segments:</strong> Target specific user groups</li>
            <li><strong>Schedule:</strong> Set delivery time and date</li>
            <li><strong>Analytics:</strong> Track open rates and click-through</li>
        </ul>
    </div>

    <!-- Analytics Section -->
    <div class="section" id="analytics">
        <h2>9. Analytics & Reports</h2>

        <h3>Sales Reports</h3>
        <ul>
            <li><strong>Daily Sales:</strong> Revenue by day with comparison</li>
            <li><strong>Monthly Trends:</strong> Month-over-month growth</li>
            <li><strong>Yearly Overview:</strong> Annual performance metrics</li>
            <li><strong>Product Performance:</strong> Best and worst selling products</li>
            <li><strong>Vendor Performance:</strong> Sales by vendor</li>
        </ul>

        <h3>User Analytics</h3>
        <ul>
            <li><strong>Registration Trends:</strong> New users over time</li>
            <li><strong>User Segments:</strong> Customers vs vendors</li>
            <li><strong>Geographic Distribution:</strong> Users by city/region</li>
            <li><strong>Retention Rate:</strong> Returning customer percentage</li>
        </ul>

        <h3>Export Options</h3>
        <ul>
            <li><strong>CSV Export:</strong> Raw data for Excel/Google Sheets</li>
            <li><strong>PDF Reports:</strong> Formatted reports with charts</li>
            <li><strong>Scheduled Reports:</strong> Automatic email delivery</li>
        </ul>

        <div class="info">
            <strong>📊 Report Types:</strong> Sales, Orders, Users, Products, Vendors, Inventory, Payouts
        </div>
    </div>

    <!-- System Settings Section -->
    <div class="section" id="settings">
        <h2>10. System Settings</h2>

        <h3>General Settings</h3>
        <table>
            <thead>
                <tr>
                    <th>Setting</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Site Name</td>
                    <td>Marketplace display name</td>
                </tr>
                <tr>
                    <td>Site Logo</td>
                    <td>Upload brand logo</td>
                </tr>
                <tr>
                    <td>Favicon</td>
                    <td>Browser tab icon</td>
                </tr>
                <tr>
                    <td>Contact Email</td>
                    <td>Primary contact email address</td>
                </tr>
                <tr>
                    <td>Contact Phone</td>
                    <td>Customer support phone</td>
                </tr>
                <tr>
                    <td>Address</td>
                    <td>Business address</td>
                </tr>
                <tr>
                    <td>Currency</td>
                    <td>Default currency (ETB)</td>
                </tr>
                <tr>
                    <td>Timezone</td>
                    <td>System timezone (Africa/Addis_Ababa)</td>
                </tr>
            </tbody>
        </table>

        <h3>Payment Settings</h3>
        <ul>
            <li><strong>Chapa Integration:</strong> API keys and webhook configuration</li>
            <li><strong>Cash on Delivery:</strong> Enable/disable COD</li>
            <li><strong>Bank Transfer:</strong> Bank account details for transfers</li>
            <li><strong>Mobile Money:</strong> Telebirr, M-Pesa settings</li>
            <li><strong>Payment Fees:</strong> Configure transaction fees</li>
        </ul>

        <h3>Email Settings</h3>
        <ul>
            <li><strong>SMTP Configuration:</strong> Host, port, username, password</li>
            <li><strong>Email Templates:</strong> Customize all notification emails</li>
            <li><strong>Test Email:</strong> Send test email to verify configuration</li>
        </ul>

        <h3>Maintenance Mode</h3>
        <ol>
            <li>Go to Settings → System</li>
            <li>Toggle "Maintenance Mode" switch</li>
            <li>Add custom maintenance message (optional)</li>
            <li>Specify allowed IP addresses (optional)</li>
            <li>Save settings</li>
        </ol>

        <div class="warning">
            <strong>⚠️ Caution:</strong> Maintenance mode makes the site inaccessible to all users except whitelisted IPs. Use during off-peak hours.
        </div>
    </div>

    <!-- FAQ Section -->
    <div class="section" id="faq">
        <h2>11. Frequently Asked Questions</h2>

        <div style="margin-top: 20px;">
            <p><strong>Q: How do I add a new admin user?</strong></p>
            <p>A: Go to Settings → Admin Management → "Add New Admin". Fill in their details and assign appropriate permissions. The new admin will receive an email with login instructions.</p>

            <p><strong>Q: How do I process vendor payouts?</strong></p>
            <p>A: Navigate to Vendors → Payouts. You can process individual payouts or use bulk payout for multiple vendors. Payouts can be done via bank transfer or mobile money.</p>

            <p><strong>Q: What should I do if a vendor complains about a dispute?</strong></p>
            <p>A: Review the order details in the Orders section. You can see all communication between customer and vendor. If needed, you can mediate and issue refunds from the admin panel.</p>

            <p><strong>Q: How do I customize email templates?</strong></p>
            <p>A: Go to Settings → Email Settings → Email Templates. You can edit the HTML content of all system emails. Use the preview function to test changes.</p>

            <p><strong>Q: How do I backup the system?</strong></p>
            <p>A: The system automatically creates daily backups. You can also manually trigger backups from Settings → System → Backup. Backups include database and uploaded files.</p>

            <p><strong>Q: How do I change the site currency?</strong></p>
            <p>A: Go to Settings → General → Currency. Note: Changing currency will affect all prices. It's recommended to do this during low activity periods.</p>

            <p><strong>Q: How do I handle fraudulent orders?</strong></p>
            <p>A: Flag the order as suspicious, contact the customer for verification, and if confirmed fraudulent, cancel the order and block the user.</p>

            <p><strong>Q: Can I export sales data for tax purposes?</strong></p>
            <p>A: Yes, go to Reports → Sales Reports, select the date range, and export as CSV or PDF. The report includes all necessary tax information.</p>
        </div>
    </div>

    <!-- Troubleshooting Section -->
    <div class="section" id="troubleshooting">
        <h2>12. Troubleshooting</h2>

        <h3>Common Issues and Solutions</h3>

        <table>
            <thead>
                <tr>
                    <th>Issue</th>
                    <th>Possible Cause</th>
                    <th>Solution</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Payment not received</td>
                    <td>Gateway timeout, incorrect webhook</td>
                    <td>Check Chapa dashboard, verify webhook URL, manually confirm payment</td>
                </tr>
                <tr>
                    <td>Email not sending</td>
                    <td>SMTP configuration incorrect</td>
                    <td>Verify SMTP settings, check spam folder, test with Mailtrap</td>
                </tr>
                <tr>
                    <td>Vendor can't login</td>
                    <td>Account not approved, suspended</td>
                    <td>Check vendor status in admin panel, verify email verification</td>
                </tr>
                <tr>
                    <td>Images not loading</td>
                    <td>Storage path incorrect, permissions</td>
                    <td>Check storage symbolic link, verify file permissions</td>
                </tr>
                <tr>
                    <td>Slow dashboard</td>
                    <td>Large data set, no caching</td>
                    <td>Enable query caching, optimize database, use pagination</td>
                </tr>
                <tr>
                    <td>404 errors on pages</td>
                    <td>Routes not cached, missing routes</td>
                    <td>Run <code>php artisan route:cache</code>, check route names</td>
                </tr>
            </tbody>
        </table>

        <h3>Error Logs</h3>
        <p>Check error logs for debugging:</p>
        <pre><code># Laravel logs
storage/logs/laravel.log

# Server logs
/var/log/nginx/error.log
/var/log/apache2/error.log

# PHP logs
/var/log/php-fpm.log</code></pre>

        <h3>Support Contacts</h3>
        <ul>
            <li><strong>Email:</strong> support@vendora.com</li>
            <li><strong>Phone:</strong> +251 912 345 678</li>
            <li><strong>Telegram:</strong> @vendora_support</li>
            <li><strong>Office:</strong> Jimma University Technology Park, Jimma, Ethiopia</li>
        </ul>

        <div class="tip">
            <strong>📝 Note:</strong> For critical issues, contact technical support immediately. Response time: Within 2 hours during business hours.
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>&copy; {{ date('Y') }} Vendora. All rights reserved.</p>
        <p>Jimma, Ethiopia | Version {{ $version ?? '2.1.0' }}</p>
        <p>Documentation generated on {{ now()->format('F j, Y \a\t g:i A') }}</p>
        <p><em>This document is confidential and intended for Vendora administrators only.</em></p>
    </div>
</body>
</html>