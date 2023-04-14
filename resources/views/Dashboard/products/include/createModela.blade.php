<div class="modal" id="modaldemo8">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">اضافة منتج</h6><button aria-label="Close" class="close" data-dismiss="modal"
                    type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="{{ route('products.store') }}" method="POST"autocomplete="off">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">
                            اسم المنتج
                        </label>
                        <input type="text" value="{{ old('product_name') }}" id="product_name" name="product_name"
                            @class([
                                'form-control',
                                'is-invalid' => $errors->has('product_name'),
                            ])>
                        @error('product_name')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>القسم</label>
                        <select name="category_id" id="category_id" class="form-control" style="width: 100%;">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->sections_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">
                            ملاحظات
                        </label>
                        <textarea class="form-control" rows="3" id="description" name="description">{{ old('description') }}</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="submit">تأكيد</button>
                    <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">اغلاق</button>
                </div>
            </form>
        </div>
    </div>
</div>
