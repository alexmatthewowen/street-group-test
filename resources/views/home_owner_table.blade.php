
<table>
    <thead>
    <tr>
        <th>Title</th>
        <th>First Name</th>
        <th>Initial</th>
        <th>Last Name</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($homeOwners as $homeOwner)
        <tr>
            <td>{{ $homeOwner['title'] }}</td>
            <td>{{ $homeOwner['first_name'] }}</td>
            <td>{{ $homeOwner['initial'] }}</td>
            <td>{{ $homeOwner['last_name'] }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
