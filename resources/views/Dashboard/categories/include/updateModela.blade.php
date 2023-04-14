    <!-- edit -->
    <div class="modal fade" id="modaldemo2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
   <div class="modal-dialog" role="document">
       <div class="modal-content">
           <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel"> تعديل القسم</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
               </button>
           </div>
           <div class="modal-body">

               <form action="categories/update" method="post" autocomplete="off">
                   @method('put')
                   @csrf
                   <div class="form-group">
                       <input type="hidden" name="id" id="id" value="">
                       <label for="recipient-name" class="col-form-label"> اسم القسم</label>
                       <input class="form-control" name="sections_name" id="sections_name" type="text">
                   </div>
                   <div class="form-group">
                       <label for="message-text" class="col-form-label">الوصف</label>
                       <textarea class="form-control" id="description" name="description"></textarea>
                   </div>
           </div>
           <div class="modal-footer">
               <button type="submit" class="btn btn-primary">تأكيد</button>
               <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
           </div>
           </form>
       </div>
   </div>
</div>
