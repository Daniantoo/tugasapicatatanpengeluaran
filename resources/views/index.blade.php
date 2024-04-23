
<h2>List of Expenses</h2>

<table>
    <thead>
        <tr>
            <th>Title</th>
            <th>Description</th>
            <th>Amount</th>
            <th>Date</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($expenses as $expense)
        <tr>
            <td>{{ $expense->title }}</td>
            <td>{{ $expense->description }}</td>
            <td>{{ $expense->amount }}</td>
            <td>{{ $expense->date }}</td>
            <td>
                <a href="{{ route('expenses.edit', $expense->id) }}">Edit</a>
                <form action="{{ route('expenses.destroy', $expense->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>