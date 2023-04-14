        <!-- edit -->
        <div class="modal fade" id="edit_Product" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"> تعديل المنتج</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="products/update" method="post" autocomplete="off">
                        @method('put')
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="title">اسم المنتج:</label>
                               <input type="hidden" class="form-control" name="id" id="id" value="">
                                <input type="text" class="form-control" name="product_name" id="product_name">
                            </div>
                            <label class="my-1 mr-2" for="inlineFormCustomSelectPref">القسم</label>
                            <select name="sections_name" id="sections_name" class="custom-select my-1 mr-sm-2" selected >
                                @foreach ($categories as $category)
                                    <option>{{ $category->sections_name }}</option>
                                @endforeach
                            </select>
                            <div class="form-group">
                                <label for="des">ملاحظات :</label>
                                <textarea name="description" rows="2" id='description' class="form-control"></textarea>
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
