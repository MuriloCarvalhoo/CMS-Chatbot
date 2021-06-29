<div class="container-fluid">
    <div class="row">
        <div class="col-9">
            <div class="app-entry-form-section" id="basic">
                <div class="section-title">Details</div>
                <div class="row">
                    <div class="col-12">
                        {!! Form::text('name')
                        -> label(trans(trans('chatbox::chatbox.label.name')))
                        -> required()
                        -> placeholder(trans(trans('chatbox::chatbox.placeholder.name')))
                        !!}

                        {!! Form::textarea('content')
                        -> label(trans('chatbox::chatbox.label.content'))
                        -> value(e($data['content']))
                        -> dataUpload(url($data->getUploadURL('content')))
                        -> addClass('html-editor-mini')
                        -> placeholder(trans('chatbox::chatbox.placeholder.content'))
                        !!}
                    </div>
                    <div class="col-12">
                        {!! Form::text('title')
                        -> label(trans('chatbox::chatbox.label.title'))
                        -> placeholder(trans('chatbox::chatbox.placeholder.title'))
                        !!}
                        {!! Form::text('heading')
                        -> label(trans('chatbox::chatbox.label.heading'))
                        -> placeholder(trans('chatbox::chatbox.placeholder.heading'))
                        !!}
                        {!! Form::text('sub_heading')
                        -> label(trans('chatbox::chatbox.label.sub_heading'))
                        -> placeholder(trans('chatbox::chatbox.placeholder.sub_heading'))
                        !!}
                        {!! Form::date('meta_title')
                        -> label(trans('chatbox::chatbox.label.meta_title'))
                        -> placeholder(trans('chatbox::chatbox.placeholder.meta_title'))
                        !!}
                    </div>
                </div>
            </div>
            <div class="app-entry-form-section" id="meta">

                <div class="section-title">Meta Details</div>
                <div class="row">
                    <div class="col-12">
                        {!! Form::text('meta_keyword')
                        -> label(trans('chatbox::chatbox.label.meta_keyword'))
                        -> placeholder(trans('chatbox::chatbox.placeholder.meta_keyword'))
                        !!}
                    </div>
                    <div class="col-6">
                        {!! Form::textarea('meta_description')
                        -> label(trans('chatbox::chatbox.label.meta_description'))
                        -> rows(3)
                        -> placeholder(trans('chatbox::chatbox.placeholder.meta_description'))
                        !!}
                    </div>
                    <div class="col-6">
                        {!! Form::textarea('abstract')
                        -> label(trans('chatbox::chatbox.label.abstract'))
                        -> rows(3)
                        -> placeholder(trans('chatbox::chatbox.placeholder.abstract'))
                        !!}
                    </div>
                </div>
            </div>
            <div class="app-entry-form-section" id="settings">

                <div class="section-title">Settings</div>
                <div class="row">
                    <div class="col-12">
                        {!! Form::range('order')
                        -> label(trans('chatbox::chatbox.label.order'))
                        -> placeholder(trans('chatbox::chatbox.placeholder.order'))
                        !!}

                        {!! Form::text('slug')
                        -> label(trans('chatbox::chatbox.label.slug'))
                        -> append('.html')
                        -> placeholder(trans('chatbox::chatbox.placeholder.slug'))
                        !!}

                    </div>
                </div>
            </div>

            <div class="app-entry-form-section" id="images">
                <div class="section-title">Images</div>
                <div class="row">
                    @if ($mode == 'create')
                    <div class="form-group">
                        <label for="images" class="control-label col-lg-12 col-sm-12 text-left">
                            {{trans('chatbox::chatbox.label.images') }}
                        </label>
                        <div class='col-12'>
                            {!! $data->files('images')
                            ->url($data->getUploadUrl('images'))
                            ->uploader()!!}
                        </div>
                    </div>
                    @elseif ($mode == 'edit')
                    <div class="form-group">
                        <label for="images" class="control-label col-lg-12 col-sm-12 text-left">
                            {{trans('chatbox::chatbox.label.images') }}
                        </label>
                        <div class='col-12'>
                            {!! $data->files('images')
                            ->url($data->getUploadUrl('images'))
                            ->uploader()!!}
                        </div>
                    </div>
                    @elseif ($mode == 'show')
                    <div class='col-12'>
                        {!! $data->files('banner') !!}
                    </div>
                    <div class='col-12'>
                        {!! $data->files('images') !!}
                    </div>
                    @endif
                </div>
                {!! Form::hidden('upload_folder') !!}
            </div>
        </div>
        <div class="col-md-3">
            <aside class="app-create-steps">
                <h5 class="steps-header">Steps</h5>
                <div class="steps-wrap" id="steps_nav">
                    <a class="step-item active" href="#basic"><span>1</span> Basic Details</a>
                    <a class="step-item" href="#meta"><span>2</span> Meta Tags</a>
                    <a class="step-item" href="#settings"><span>3</span> Settings</a>
                    <a class="step-item" href="#images"><span>4</span> Images & Videos</a>
                </div>
            </aside>
        </div>
    </div>
</div>
<br />
<br />
<br />