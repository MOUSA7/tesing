<div class="form-group">
    <label for="title">{{__('Title')}} :</label>
    <input type="text" value="{{old('title',$post->title ?? null)}}" name="title" class="form-control" placeholder="Title">
</div>

<div class="form-group">
    <label for="content">{{__('Content')}} :</label>
    <textarea type="text"  name="content" class="form-control" placeholder="Content">{{old('content',$post->content ?? null)}}</textarea>
</div>

<div class="form-group">
    <label for="image">{{__('Thumbnail')}} :</label>
    <input type="file" name="image" class="form-control-file" >
</div>

<input type="submit" value="{{__('Create!')}}" class="btn btn-primary">
