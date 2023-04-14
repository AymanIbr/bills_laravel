<div class="modal" id="modaldemo8">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">اضافة قسم</h6><button aria-label="Close" class="close" data-dismiss="modal"
                    type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="{{ route('categories.store') }}" method="POST"autocomplete="off">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">
                            اسم القسم
                        </label>
                        <input type="text" value="{{ old('sections_name') }}" id="sections_name" name="sections_name"
                            @class([
                                'form-control',
                                'is-invalid' => $errors->has('sections_name'),
                            ])>
                        @error('sections_name')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
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
