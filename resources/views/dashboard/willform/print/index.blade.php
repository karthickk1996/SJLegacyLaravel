@php
    $form = \App\Models\Form::where('form_type',$data->hasMirrorWill ? 'mirror-will' : 'single-will' )->first();
    $content = $form->content;





@endphp

{!! $form->content !!}
