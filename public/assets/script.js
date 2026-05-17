// DOM Elements
let deals = [];
let searchQuery = '';
let activeCategory = 'All';
let selectedDeal = null;

// Utility Functions
function formatTimeAgo(dateString) {
    const date = new Date(dateString);
    const now = new Date();
    const seconds = Math.floor((now.getTime() - date.getTime()) / 1000);
    
    let interval = seconds / 31536000;
    if (interval > 1) return Math.floor(interval) + 'y ago';
    interval = seconds / 2592000;
    if (interval > 1) return Math.floor(interval) + 'mo ago';
    interval = seconds / 86400;
    if (interval > 1) return Math.floor(interval) + 'd ago';
    interval = seconds / 3600;
    if (interval > 1) return Math.floor(interval) + 'h ago';
    interval = seconds / 60;
    if (interval > 1) return Math.floor(interval) + 'm ago';
    return 'Just now';
}

function formatCurrency(amount) {
    return new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: 'USD'
    }).format(amount);
}

function getStatusBadge(status, className = '') {
    const config = {
        'Available': { class: 'status-available', text: '✓ Available' },
        'Going Fast': { class: 'status-going', text: '⏰ Going Fast' },
        'Gone': { class: 'status-gone', text: '✗ Gone' }
    };
    const statusConfig = config[status] || config['Available'];
    return `<div class="status-badge ${statusConfig.class} ${className}">${statusConfig.text}</div>`;
}

// Escape HTML to prevent XSS
function escapeHtml(str) {
    if (!str) return '';
    return str.replace(/[&<>]/g, function(m) {
        if (m === '&') return '&amp;';
        if (m === '<') return '&lt;';
        if (m === '>') return '&gt;';
        return m;
    });
}

// Filter Deals
function getFilteredDeals() {
    let filtered = deals.filter(deal => {
        const matchesSearch = deal.itemName.toLowerCase().includes(searchQuery.toLowerCase()) ||
                              deal.storeName.toLowerCase().includes(searchQuery.toLowerCase());
        const matchesCategory = activeCategory === 'All' || deal.category === activeCategory;
        return matchesSearch && matchesCategory;
    });
    return filtered;
}

// Render Deals Grid
function renderDeals() {
    const filteredDeals = getFilteredDeals();
    const dealsGrid = document.querySelector('.deals-grid');
    
    if (!dealsGrid) return;
    
    if (filteredDeals.length === 0) {
        dealsGrid.innerHTML = `
            <div class="empty-state" style="grid-column: 1/-1;">
                <div class="empty-icon">🔥</div>
                <h3>No steals found</h3>
                <p>We couldn't find any deals matching your search. Be the first to post a steal in this category!</p>
                <button class="submit-btn" style="margin-top: 1.5rem;" onclick="openPostModal()">+ Post a Deal</button>
            </div>
        `;
        return;
    }
    
    dealsGrid.innerHTML = filteredDeals.map(deal => `
        <div class="deal-card ${deal.status === 'Gone' ? 'status-gone' : ''}" data-deal-id="${deal.id}">
            <div class="card-image">
                <img src="${deal.imageUrl}" alt="${escapeHtml(deal.itemName)}" loading="lazy">
                <div class="status-badge-container">
                    ${getStatusBadge(deal.status)}
                </div>
                <div class="discount-badge">${deal.savingsPercent}% OFF</div>
            </div>
            <div class="card-content">
                <h3>${escapeHtml(deal.itemName)}</h3>
                <div class="store-info">🏪 ${escapeHtml(deal.storeName)}</div>
                <div class="price-section">
                    <div>
                        <div class="original-price">${formatCurrency(deal.originalPrice)}</div>
                        <div class="deal-price">${formatCurrency(deal.dealPrice)}</div>
                    </div>
                    <div class="location-time">
                        <div>📍 ${escapeHtml(deal.location)}</div>
                        <div>🕒 ${formatTimeAgo(deal.timePosted)}</div>
                    </div>
                </div>
                <div style="margin-top: 15px;">
                    <a href="index.php?controller=comment&action=show&deal_id=${deal.id}" 
                       style="display: inline-block; background: #10b981; color: white; padding: 8px 16px; border-radius: 8px; text-decoration: none; font-size: 14px; font-weight: bold;">
                        💬 View Comments
                    </a>
                </div>
            </div>
        </div>
    `).join('');
    
    // Add click event listeners to deal cards (for modal)
    document.querySelectorAll('.deal-card').forEach(card => {
        card.addEventListener('click', (e) => {
            // Don't open modal if clicking on the comments link
            if (e.target.closest('a')) return;
            
            const dealId = card.dataset.dealId;
            const deal = deals.find(d => d.id == dealId);
            if (deal && typeof openDetailModal === 'function') openDetailModal(deal);
        });
    });
}

// Handle Search
function setupSearch() {
    const searchInput = document.querySelector('.search-input');
    if (searchInput) {
        searchInput.addEventListener('input', (e) => {
            searchQuery = e.target.value;
            renderDeals();
        });
    }
}

// Handle Category Filter
function setupCategories() {
    const categoryBtns = document.querySelectorAll('.category-btn');
    categoryBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            const category = btn.textContent;
            activeCategory = category;
            
            // Update active state
            categoryBtns.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            
            renderDeals();
        });
    });
}

// Post Deal Modal
function openPostModal() {
    const modal = document.querySelector('.modal-overlay');
    if (modal) modal.style.display = 'flex';
}

function closePostModal() {
    const modal = document.querySelector('.modal-overlay');
    if (modal) modal.style.display = 'none';
    document.getElementById('postDealForm')?.reset();
}

function handlePostDeal(event) {
    event.preventDefault();
    const form = event.target;
    
    // Get form values
    const inputs = form.querySelectorAll('input');
    const itemName = inputs[0]?.value;
    const storeName = inputs[1]?.value;
    const location = inputs[2]?.value;
    const dealPrice = parseFloat(inputs[3]?.value);
    const originalPrice = parseFloat(inputs[4]?.value);
    const posterName = inputs[5]?.value;
    const category = form.querySelector('select')?.value;
    const notes = form.querySelector('textarea')?.value;
    
    if (!itemName || !storeName || !dealPrice || !originalPrice || !location || !posterName) {
        alert('Please fill in all required fields');
        return;
    }
    
    const savingsPercent = Math.round(((originalPrice - dealPrice) / originalPrice) * 100);
    
    // Category images
    const categoryImages = {
        Electronics: 'https://images.unsplash.com/photo-1498049794561-7780e7231661?auto=format&fit=crop&q=80&w=800',
        Fashion: 'https://images.unsplash.com/photo-1445205170230-053b83016050?auto=format&fit=crop&q=80&w=800',
        Groceries: 'https://images.unsplash.com/photo-1542838132-92c53300491e?auto=format&fit=crop&q=80&w=800',
        Home: 'https://images.unsplash.com/photo-1513694203232-719a280e022f?auto=format&fit=crop&q=80&w=800',
        Sports: 'https://images.unsplash.com/photo-1461896836934-ffe607ba8211?auto=format&fit=crop&q=80&w=800',
        Other: 'https://images.unsplash.com/photo-1513885535751-8b9238bd345a?auto=format&fit=crop&q=80&w=800'
    };
    
    const newDeal = {
        id: Math.random().toString(36).substr(2, 9),
        itemName: itemName,
        storeName: storeName,
        dealPrice: dealPrice,
        originalPrice: originalPrice,
        savingsPercent: savingsPercent,
        location: location,
        timePosted: new Date().toISOString(),
        posterName: posterName,
        status: 'Available',
        imageUrl: categoryImages[category] || categoryImages['Other'],
        category: category,
        notes: notes || ''
    };
    
    deals = [newDeal, ...deals];
    closePostModal();
    renderDeals();
}

// Detail Modal
function openDetailModal(deal) {
    selectedDeal = deal;
    const modal = document.querySelector('.detail-modal-overlay');
    if (!modal) return;
    
    // Populate modal content
    const detailImage = modal.querySelector('.detail-image img');
    const detailTitle = modal.querySelector('.detail-header h2');
    const detailPrices = modal.querySelector('.detail-prices');
    const detailInfoGrid = modal.querySelector('.detail-info-grid');
    const detailNotes = modal.querySelector('.detail-notes');
    const detailPoster = modal.querySelector('.detail-poster');
    const detailBadges = modal.querySelector('.detail-badges');
    
    if (detailImage) detailImage.src = deal.imageUrl;
    if (detailTitle) detailTitle.textContent = deal.itemName;
    if (detailPrices) {
        detailPrices.innerHTML = `
            <div class="original">${formatCurrency(deal.originalPrice)}</div>
            <div class="deal">${formatCurrency(deal.dealPrice)}</div>
        `;
    }
    
if (detailInfoGrid) {
    detailInfoGrid.innerHTML = `
        <div class="info-item">🏪 <span class="info-label">Store:</span> ${escapeHtml(deal.storeName)}</div>
        <div class="info-item">📍 <span class="info-label">Location:</span> ${escapeHtml(deal.location)}</div>
        <div class="info-item">🏷️ <span class="info-label">Category:</span> ${deal.category}</div>
        <div class="info-item">🕒 <span class="info-label">Posted:</span> ${formatTimeAgo(deal.timePosted)}</div>
        <div class="info-item">💬 <span class="info-label">Comments:</span> <a href="index.php?controller=comment&action=show&deal_id=${deal.id}" style="color: #f97316; text-decoration: none; font-weight: bold;">Click here to view & add comments →</a></div>
    `;
}
    
    if (detailNotes) {
        if (deal.notes) {
            detailNotes.innerHTML = `
                <h4>Poster Notes</h4>
                <p>${escapeHtml(deal.notes)}</p>
            `;
            detailNotes.style.display = 'block';
        } else {
            detailNotes.style.display = 'none';
        }
    }
    
    if (detailPoster) {
        detailPoster.innerHTML = `👤 Found by <strong>${escapeHtml(deal.posterName)}</strong>`;
    }
    
    if (detailBadges) {
        detailBadges.innerHTML = getStatusBadge(deal.status);
    }
    
    modal.style.display = 'flex';
}

function closeDetailModal() {
    const modal = document.querySelector('.detail-modal-overlay');
    if (modal) modal.style.display = 'none';
    selectedDeal = null;
}

function updateDealStatus(status) {
    if (!selectedDeal) return;
    deals = deals.map(deal => 
        deal.id === selectedDeal.id ? { ...deal, status: status } : deal
    );
    selectedDeal.status = status;
    renderDeals();
    
    // Update modal badge
    const modal = document.querySelector('.detail-modal-overlay');
    if (modal) {
        const detailBadges = modal.querySelector('.detail-badges');
        if (detailBadges) detailBadges.innerHTML = getStatusBadge(status);
    }
}

// Setup Modals
function setupModals() {
    // Post modal triggers
    const postBtns = document.querySelectorAll('.desktop-post-btn, .mobile-post-btn');
    postBtns.forEach(btn => {
        btn.addEventListener('click', openPostModal);
    });
    
    // Close post modal
    const closeModalBtn = document.querySelector('.close-modal');
    const cancelBtn = document.querySelector('.cancel-btn');
    const modalOverlay = document.querySelector('.modal-overlay');
    
    if (closeModalBtn) closeModalBtn.addEventListener('click', closePostModal);
    if (cancelBtn) cancelBtn.addEventListener('click', closePostModal);
    if (modalOverlay) {
        modalOverlay.addEventListener('click', (e) => {
            if (e.target === modalOverlay) closePostModal();
        });
    }
    
    // Post form submission
    const postForm = document.getElementById('postDealForm');
    if (postForm) {
        postForm.addEventListener('submit', handlePostDeal);
    }
    
    // Close detail modal
    const detailCloseBtn = document.querySelector('.detail-close');
    const detailModalOverlay = document.querySelector('.detail-modal-overlay');
    if (detailCloseBtn) detailCloseBtn.addEventListener('click', closeDetailModal);
    if (detailModalOverlay) {
        detailModalOverlay.addEventListener('click', (e) => {
            if (e.target === detailModalOverlay) closeDetailModal();
        });
    }
    
    // Status update buttons
    const statusBtns = document.querySelectorAll('.status-update');
    statusBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            if (btn.classList.contains('available')) updateDealStatus('Available');
            else if (btn.classList.contains('going')) updateDealStatus('Going Fast');
            else if (btn.classList.contains('gone')) updateDealStatus('Gone');
        });
    });
}

// Upload area click handler
function setupUploadArea() {
    const uploadArea = document.querySelector('.upload-area');
    if (uploadArea) {
        uploadArea.addEventListener('click', () => {
            alert('Photo upload would open file picker. For demo, image will use category default.');
        });
    }
}

// Initialize App
function init() {
    // Use deals from server (passed from PHP) or fallback to empty array
    deals = window.dealsFromServer || [];
    renderDeals();
    setupSearch();
    setupCategories();
    setupModals();
    setupUploadArea();
}

// Run when DOM is ready
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
} else {
    init();
}