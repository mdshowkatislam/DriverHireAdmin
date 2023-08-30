<form action="{{ route('notification.update', $notification->id) }}" method="POST">
    @csrf
    <div class="modal-body">
        <div class="form-group">
            <label for="">Template For</label>
            <input type="text" name="template_subject" value="{{ $notification->template_subject }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="">Template Body</label>
            <textarea name="template_body" id="" class="form-control" required cols="30" rows="10">{{ $notification->template_body }}</textarea>
        </div>

    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Update </button>
    </div>
</form>
