@extends('profilelayout')
@section('content')
    <div class="uploadheader">
        <h3 id="upheader">Upload</h3>
    </div>
    <div class="wrapper">
        <div class="ulcontainer" style="white-space: nowrap; padding: 0px; height: 100%;">
            <div class="form-group">
                <div class="">
                    {!! Form::text('interpret', null, ['id' => 'interpret', 'class' => 'form-control', 'placeholder' => 'Artist']) !!}
                </div>
            </div>
            <div class="form-group">
                <div class="">
                    {!! Form::text('songtitle', null, ['id' => 'songtitle', 'class' => 'form-control', 'placeholder' => 'Songtitle']) !!}
                </div>
            </div>
            <div class="form-group">
                <div class="">
                    {!! Form::text('imgsource', null, ['id' => 'imgsource', 'class' => 'form-control', 'placeholder' => 'Video Source (This is not for links!)']) !!}
                </div>
            </div>
            <div class="form-group">
                <div class="">
                    <?php
                        $categories = [];
                        foreach(App\Models\Category::all() as $cat)
                            $categories[$cat->id] = $cat->name;
                    ?>
                    {!! Form::select('category', $categories, 8, ['id' => 'category', 'class' => 'form-control']) !!}
                </div>
            </div>
            <div class="form-group">
                <div class="blah">
                    {!! Form::checkbox('nsfw', 'true', false, ['id' => 'nsfw']) !!} <label id="nsfw" for="nsfw">NSFW?</label>
                </div>
            </div>
            <div class="form-group">
                <div class="ultags">
                    {!! Form::text('tags', null, ['id' => 'tags_upload', 'class' => 'form-control', 'placeholder' => 'Input tags...', 'name' => 'tags', 'data-role' => 'tagsinput']) !!}
                </div>
	    </div>
<div class="form-group">
        <div id="dragndrop" class="form-group col-md-3" data-uploadlimit="{{ isset($user) ? ($user->can('break_max_filesize') ? 'false' : 'true') : 'true' }}">
            <a id="dragndrop-link" href="#">
                <span style="display: table; width: 100%; height: 100%;">
                    <span id="dragndrop-text">
                        <i class="fa fa-cloud-upload"></i><br>
                        Drop or select WebM!
                    </span>
                </span>
            </a>
        </div>
</div>

            <div class="form-group">
                <div class="col-md-12">
                    <button id="btn-upload" type="button" style="width: 100%; height: 40px;" class="btn btn-primary btn-sm">Fire the laz0r</button>
		    <p style="text-align:center; padding-top: 5px; white-space: normal;">Before you click upload make sure you have read the <a href="/rules">Rules</a></p>
		    <p style="text-align:center; padding-top: 5px; white-space: normal;"><span id="big">35</span> uploads <span id="big">every 12 hours.</span> – Maximum filesize: <span id="big">100MB.</span> – Only <span id="big">.webm</span> allowed. Need <a href="/webm">help?</a></p>
		    <div class="guidelinez">
			<p id="hguide">Upload Guidelines for w0bm.moe</p>
			<ul id="ulguide">
			<li>Your WebM needs to have sound!</li>
			<li>We have a zero tolerance policy against Childporn, don't upload it!</li>
			<li>Ask yourself: Does my upload fit in here?</li>
			</ul>
		   </div>
                </div>
            </div>
        <input name="file" type="file" class="hidden" accept=".webm"></input>
    </div>
</div>
@endsection
