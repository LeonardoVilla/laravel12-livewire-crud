<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;

class PostCrud extends Component
{
    public $posts;

    public $title;

    public $body;

    public $post_id;

    public $isEdit = false;

    protected $rules = [
        'title' => 'required|string|max:255',
        'body' => 'required|string',
    ];

    public function render()
    {
        $this->posts = Post::latest()->get();

        return view('livewire.post-crud')->layout('layouts.app');
    }

    public function resetInput()
    {
        $this->title = '';
        $this->body = '';
        $this->post_id = null;
        $this->isEdit = false;
    }

    public function store()
    {
        $this->validate();
        Post::create([
            'title' => $this->title,
            'body' => $this->body,
        ]);
        session()->flash('message', 'Post criado com sucesso.');
        $this->resetInput();
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $this->post_id = $post->id;
        $this->title = $post->title;
        $this->body = $post->body;
        $this->isEdit = true;
    }

    public function update()
    {
        $this->validate();
        if ($this->post_id) {
            $post = Post::find($this->post_id);
            $post->update([
                'title' => $this->title,
                'body' => $this->body,
            ]);
            session()->flash('message', 'Post atulizado com sucesso.');
            $this->resetInput();
        }
    }

    public function delete($id)
    {
        Post::find($id)->delete();
        session()->flash('message', 'Post deletado com sucesso.');
    }
}
