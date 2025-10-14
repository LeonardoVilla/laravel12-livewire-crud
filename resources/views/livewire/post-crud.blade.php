<div>
    <h2>Livewire CRUD Example</h2>
@if (session()->has('message'))
        <div style="color: green;">{{ session('message') }}</div>
    @endif
    <form wire:submit.prevent="{{ $isEdit ? 'update' : 'store' }}">
        <input type="text" wire:model="title" placeholder="Title"><br>
        @error('title') <span style="color:red;">{{ $message }}</span><br> @enderror
        <textarea wire:model="body" placeholder="Body"></textarea><br>
        @error('body') <span style="color:red;">{{ $message }}</span><br> @enderror
        <button type="submit">{{ $isEdit ? 'Update' : 'Save' }}</button>
        @if($isEdit)
            <button type="button" wire:click="resetInput">Cancel</button>
        @endif
    </form>
    <hr>
    <table border="1" cellpadding="5">
        <tr>
            <th>ID</th><th>Title</th><th>Body</th><th>Actions</th>
        </tr>
        @foreach($posts as $post)
        <tr>
            <td>{{ $post->id }}</td>
            <td>{{ $post->title }}</td>
            <td>{{ $post->body }}</td>
            <td>
                <button wire:click="edit({{ $post->id }})">Edit</button>
                <button wire:click="delete({{ $post->id }})">Delete</button>
            </td>
        </tr>
        @endforeach
    </table>
</div>