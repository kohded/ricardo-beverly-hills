{{--Comments--}}
<div class="row clearfix">
    <div class="col-xs-12">
        <h3>Comments</h3>
        <hr>
    </div>

    @foreach ($comments as $comment)
        <div class="col-xs-12">
            <p><strong>Name: </strong>{{ $comment->author }}</p>
            <p><strong>Created: </strong>{{ $comment->created_at }}</p>
            <p><strong>Comment: </strong>{{ $comment->comment }}</p>
            <hr/>
        </div>
    @endforeach
</div>