    <!-- Post Deal Modal -->
<div class="modal-overlay" style="display: none;">
    <div class="modal-container">
        <div class="modal-header">
            <h2>Post a Steal</h2>
            <button class="close-modal">✕</button>
        </div>
        <div class="modal-body">
            <form id="postDealForm">
                <div class="upload-area">
                    <div class="upload-placeholder">📷 Click to upload photo</div>
                    <small>Required to prove the deal!</small>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Item Name</label>
                        <input type="text" placeholder="e.g. Sony WH-1000XM5" required>
                    </div>
                    <div class="form-group">
                        <label>Category</label>
                        <select required>
                            <option>Electronics</option>
                            <option>Fashion</option>
                            <option>Groceries</option>
                            <option>Home</option>
                            <option>Sports</option>
                            <option>Other</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Store Name</label>
                        <input type="text" placeholder="e.g. Target" required>
                    </div>
                    <div class="form-group">
                        <label>Specific Location</label>
                        <input type="text" placeholder="e.g. Aisle 14, Endcap" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Deal Price</label>
                        <input type="number" step="0.01" placeholder="0.00" required>
                    </div>
                    <div class="form-group">
                        <label>Original Price</label>
                        <input type="number" step="0.01" placeholder="0.00" required>
                    </div>
                </div>
                <div class="form-group">
                    <label>Notes (Optional)</label>
                    <textarea rows="2" placeholder="Any details? (e.g. Only 3 left, open box)"></textarea>
                </div>
                <div class="form-group">
                    <label>Your Name</label>
                    <input type="text" placeholder="How should we credit you?" required>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button class="cancel-btn">Cancel</button>
            <button class="submit-btn">Post Steal</button>
        </div>
    </div>
</div>

<!-- Deal Detail Modal -->
<div class="detail-modal-overlay" style="display: none;">
    <div class="detail-modal-container">
        <div class="detail-image">
            <img src="" alt="">
            <button class="detail-close">✕</button>
            <div class="detail-badges"></div>
        </div>
        <div class="detail-content">
            <div class="detail-header">
                <h2></h2>
                <div class="detail-prices"></div>
            </div>
            <div class="detail-info-grid"></div>
            <div class="detail-notes"></div>
            <div class="detail-poster"></div>
            <div class="status-update-section">
                <h4>⚠️ Are you at the store? Update the status!</h4>
                <div class="status-buttons">
                    <button class="status-update available">Still There</button>
                    <button class="status-update going">Going Fast</button>
                    <button class="status-update gone">All Gone</button>
                </div>
            </div>
        </div>
    </div>
</div>

</main>
</body>
</html>
    </main>
</body>
</html>