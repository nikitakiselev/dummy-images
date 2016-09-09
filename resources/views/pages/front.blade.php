@extends('app')

@section('jumbotron')
    <div class="jumbotron">
        <div class="container">
            <h1>Dummy Images</h1>
            <p>
                This service allows you to receive a random picture. Simply insert the image on the page <br>
                <code>
                    &lt;img src=&quot;https://images.nikitakiselev.ru/random&quot; alt=&quot;Random image&quot;&gt;
                </code>
            </p>
            <p>
                <a class="btn btn-primary btn-lg" href="#" role="button" disabled>Upload new images</a>
            </p>
        </div>
    </div>
@endsection

@section('content')
    <h2>Simple using</h2>
    <p><code>https://images.nikitakiselev.ru/random</code> - Get a random original size image</p>
    <p><code>https://images.nikitakiselev.ru/random/400</code> - Get a random image with width 400px</p>
    <p><code>https://images.nikitakiselev.ru/random/300/200</code> - Get a random image resized to 300x200</p>

    <h2>Download some images to project folder</h2>
    <p>You can download some images to project folder for demo purposes. Just using this script.</p>
    <pre>php -r "$(curl -fsSL https://gist.githubusercontent.com/nikitakiselev/6bc24602253e9637233715d24cc9fd31/raw)" 20</pre>
    <p>Scripts will download 20 images to the current folder.</p>
@endsection