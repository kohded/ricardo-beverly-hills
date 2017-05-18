<div id="comments" class="col-sm-12 col-md-6">
    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title">
                <span class="fa fa-comments" aria-hidden="true"></span>
                Comments
            </h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <form action="
                @role('ricardo-beverly-hills')
                {{ route('claim.add-comment') }}
                @endrole
                @role('part-company')
                {{ route('pc-add-comment') }}
                @endrole
                        " method="post">
                    {{--Comment--}}
                    <div class="form-group col-xs-12">
                        <textarea class="form-control" id="comment-comment" name="comment"
                                  placeholder="Enter new comment..." required></textarea>
                    </div>
                    {{--Submit--}}
                    <div class="form-group col-xs-12 mb-10">
                        <button class="btn btn-primary pull-right" type="submit">Add</button>
                    </div>
                    {{--Id--}}
                    <input name="claim_id" value="{{ $claim[0]->claim_id }}" type="hidden">
                    {{--Token--}}
                    {{ csrf_field() }}
                </form>
            </div>
            @foreach ($comments as $comment)
                <hr class="mt-10">
                <div class="row">
                    <div class="col-sm-3 col-md-5 col-lg-4">
                        {{--Author--}}
                        <p class="detail-label bold-text">
                            <span class="fa fa-user-circle" aria-hidden="true"></span>
                            {{ $comment->author }}
                        </p>
                        {{--Created At--}}
                        <p class="detail-label bold-text">
                            {{ $comment->created_at }}
                        </p>
                    </div>
                    <div class="comment-container col-sm-9 col-md-7 col-lg-8">
                        <p class="original-comment col-md-10" id="original-comment-{{$comment->id}}">
                            <span class="fa fa-comment" aria-hidden="true"></span>
                            {{ $comment->comment }}
                        </p>
                        @if(Auth::user()->id == $comment->author_id)
                            <button id="comment-edit-link-{{$comment->id}}" class="comment-edit-links col-md-2 pull-right" effected-id="{{$comment->id}}" >Edit</button>
                            <form id="comment-form-{{$comment->id}}" class="hidden" action="{{route('edit-claim-comment')}}" method="post">
                                {{--Comment--}}
                                <div class="form-group col-xs-12">
                                    <textarea class="form-control" id="comment-comment" name="comment"
                                  placeholder="Enter new comment..." required>{{ $comment->comment }}</textarea>
                                </div>
                                {{--Submit--}}
                                <div class="form-group col-xs-12 mb-10">
                                    <button id="comment-cancel-edit-{{$comment->id}}" class="comment-cancel-edit btn btn-danger pull-right" effected-id="{{$comment->id}}">Cancel</button>
                                    <button class="btn btn-primary pull-right" type="submit">Submit</button>
                                </div>
                                {{--Id--}}
                                <input name="comment_id" value="{{ $comment->id }}" type="hidden">
                                <input name="claim_id" value="{{ $claim[0]->claim_id }}" type="hidden">
                                {{--Token--}}
                                {{ csrf_field() }}
                            </form>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

