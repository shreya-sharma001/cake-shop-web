
<form action="{{ route('updateUsers', $usercake->id) }}" method="POST">
    @csrf

    <input type="text" name="name" value="{{ $usercake->name }}" placeholder="Name">
    <input type="text" name="phone" value="{{ $usercake->phone }}" placeholder="Phone">
    <select name="class">
        <option value="Studying Class" {{ $usercake->class == 'Studying Class' ? 'selected' : '' }}>Studying Class</option>
        <option value="Writting Class" {{ $usercake->class == 'Writting Class' ? 'selected' : '' }}>Writting Class</option>
        <option value="Reading Class" {{ $usercake->class == 'Reading Class' ? 'selected' : '' }}>Reading Class</option>
    </select>
    <input type="text" name="requirements" value="{{ $usercake->requirements }}" placeholder="Requirements">

    <button type="submit" class="site-btn">Update</button>
</form>
