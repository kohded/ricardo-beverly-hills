<!doctype html>
<html lang="en">
@include('mail.partials.head', ['title' => 'Part Order'])
<body>
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-body">
                @include('mail.partials.claim-info', ['emailFor' => 'Part Order'])
            </div>
        </div>
    </div>
</body>
</html>