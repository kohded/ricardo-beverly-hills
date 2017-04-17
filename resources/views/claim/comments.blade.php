<div class="row">
    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title">
                <span class="fa fa-comments" aria-hidden="true"></span>
                Comments
            </h3>
        </div>

        <table class="table table-conensed">
            <tr>
                <td colspan="3">
                    <form action="
                    	@role('ricardo-beverly-hills') 
                    		{{ route('claim.add-comment') }} 
                    	@endrole
                    	@role('part-company') 
                    		{{ route('pc-add-comment') }} 
                    	@endrole
                    " method="post">
                        <input type="hidden" name="claim_id"
                               value="{{ $claim[0]->claim_id }}">
                        <div class="form-group col-xs-9">
                            <input type="text" class="form-control" id="comment-comment"
                                   name="comment" placeholder="Enter new comment..."
                                   required>
                        </div>
                        <div class="form-group col-xs-3">
                            <button class="btn btn-primary" type="submit">Add Comment
                            </button>
                        </div>
                        {{ csrf_field() }}
                    </form>
                </td>
            </tr>
            @foreach ($comments as $comment)
                <tr>
                    <td>
                        <dl class="dl-horizontal">
                            <dt>
                                <span class="fa fa-user-circle"
                                      aria-hidden="true"></span>
                                {{ $comment->author }}<br>
                                {{ $comment->created_at }}
                            </dt>
                            <dd>
                                <span class="fa fa-comment"
                                      aria-hidden="true"></span>
                                {{ $comment->comment }}
                            </dd>
                        </dl>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
</div>