<!DOCTYPE html>
<html>
<head>
    <title>Edit Menu Item</title>
</head>
<body>

<h1>Edit Menu Item</h1>

<form action="{{ route('menu-items.update', $menuItem->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <label>Name:</label><br>
    <input type="text" name="name" value="{{ $menuItem->name }}"><br><br>

    <label>Description:</label><br>
    <textarea name="description">{{ $menuItem->description }}</textarea><br><br>

    <label>Price:</label><br>
    <input type="number" step="0.01" name="price" value="{{ $menuItem->price }}"><br><br>

    <label>Current Image:</label><br>
    @if($menuItem->image)
        <img src="{{ asset($menuItem->image) }}" width="120"><br><br>
    @endif

    <label>Replace Image:</label><br>
    <input type="file" name="image"><br><br>

    <button type="submit">Update</button>
</form>

</body>
</html>