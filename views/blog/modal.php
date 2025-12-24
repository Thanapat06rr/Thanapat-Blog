    <div class="modal fade" id="blogModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="modalTitle">เขียนบทความใหม่</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="blogForm">
                        <input type="hidden" id="blog_id" name="id">
                        <input type="hidden" id="form_action" name="action" value="create_blog">

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="title" name="title" placeholder="Title">
                            <label for="title">หัวข้อบทความ</label>
                        </div>

                        <div class="form-floating mb-3">
                            <textarea class="form-control" id="description" name="description" placeholder="Desc" style="height: 150px"></textarea>
                            <label for="description">เนื้อหาบทความ</label>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-md">บันทึกข้อมูล</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
