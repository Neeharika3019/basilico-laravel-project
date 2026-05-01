<!DOCTYPE html>
<html>
<head>
    <title>Add Menu Item</title>
</head>
<body>

<h1>Add New Menu Item</h1>

<form action="{{ route('menu-items.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <label>Name:</label><br>
    <input type="text" name="name" required><br><br>

    <label>Description:</label><br>
    <textarea name="description"></textarea><br><br>

    <label>Price:</label><br>
    <input type="number" step="0.01" name="price" required><br><br>

    <label>Category:</label><br>
    <select name="category_id" required>
        <option value="">-- Select Category --</option>

        @foreach($categories as $category)
            <option value="{{ $category->id }}">
                {{ $category->name }}
            </option>
        @endforeach
    </select>

    <br><br>

    <label>Tags:</label><br>

    @foreach($tags as $tag)
        <input type="checkbox" name="tags[]" value="{{ $tag->id }}">
        {{ $tag->name }} <br>
    @endforeach

    <br><br>


    <label>Image:</label><br>
    <input type="file" name="image" accept="image/*"><br><br>

    <button type="submit">Save</button>
</form>

</body>
</html>