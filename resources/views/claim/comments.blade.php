<div class="row">
    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title">
                <span class="fa fa-comments" aria-hidden="true"></span>
                Comments
            </h3>
        </div>

        <table class="table table-conensed">
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
            <tr>
                <td colspan="3">
                    <form action="{{ route('claim.add-comment') }}" method="post">
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
        </table>
    </div>
</div>