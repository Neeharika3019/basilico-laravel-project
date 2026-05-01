<!DOCTYPE html>
<html>
<head>
    <title>Menu Items</title>
</head>
<body>

<h1>Menu Items</h1>
<a href="{{ route('menu-items.create') }}">
    <button>Add New Menu Item</button>
</a>

<br><br>


<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Description</th>
        <th>Price</th>
        <th>Category</th>
        <th>Tags</th>
        <th>Image</th>
        <th>Actions</th>
    </tr>

    @foreach($menuItems as $item)
        <tr>
            <td>{{ $item->id }}</td>
            <td>{{ $item->name }}</td>
            <td>{{ $item->description }}</td>
            <td>{{ $item->price }}</td>
            <td>{{ $item->category->name ?? 'No Category' }}</td>

            <td>
                @foreach($item->tags as $tag)
                    <span>{{ $tag->name }}</span><br>
                @endforeach
            </td>

            <td>
                @if($item->image)
                    <img src="{{ asset($item->image) }}" width="100">
                @else
                    No Image
                @endif
            </td>

            <td>
                <a href="{{ route('menu-items.edit', $item->id) }}">Edit</a>

                <form action="{{ route('menu-items.destroy', $item->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')

                    <button type="submit" onclick="return confirm('Delete this item?')">
                        Delete
                    </button>
                </form>
            </td>

        </tr>
    @endforeach

</table>

<br>

{{ $menuItems->links() }}

</body>
</html>