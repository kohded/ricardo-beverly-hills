<!doctype html>
<html lang="en">
@include('mail.partials.head', ['title' => 'Replace Order'])
<body>
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-body">
                @include('mail.partials.claim-info', ['emailFor' => 'Replace Order'])
            </div>
        </div>
    </div>
</body>
</html>