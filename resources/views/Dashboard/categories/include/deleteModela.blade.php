      <!-- delete -->
      <div class="modal" id="modaldemo9">
          <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content modal-content-demo">
                  <div class="modal-header">
                      <h6 class="modal-title"> حذف القسم</h6><button aria-label="Close" class="close" data-dismiss="modal"
                          type="button"><span aria-hidden="true">&times;</span></button>
                  </div>
                  <form action="categories/destroy" method="post">
                      @method('delete')
                      @csrf
                      <div class="modal-body">
                          <p>هل أنت متأكد من عملية الحذف ؟ </p><br>
                          <input type="hidden" name="id" id="id" value="">
                          <input class="form-control" name="sections_name" id="sections_name" type="text" readonly>
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                          <button type="submit" class="btn btn-danger">تأكيد</button>
                      </div>
              </div>
              </form>
          </div>
      </div>
