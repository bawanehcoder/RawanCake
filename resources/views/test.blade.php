<form action="/test2" method="post" enctype="multipart/form-data"  >
    @csrf
    <input type="file" multiple  name="images[]">
    <input type="submit" value="save">
</form>
