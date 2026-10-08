<?php

use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

new #[Title('イベントを登録')] class extends Component {

    #[Validate('required|date|after:start_at')]
    public string $due_at = '';

    public function save(): void
    {
        $validated = $this->validate();

        // ログイン中のユーザーのイベントとして保存する（user_id が自動で入る）
        auth()->user()->todos()->create($validated);

        session()->flash('status', 'todoを登録しました。');

        $this->redirectRoute('todos.index', navigate: true);
    }
};
?>

<div class="mx-auto max-w-2xl space-y-6">
    <flux:heading size="xl">todoを登録</flux:heading>

    <form wire:submit="save" class="space-y-6">

<div class="flex justify-end gap-3">
    <flux:button :href="route('todos.index')" variant="ghost" wire:navigate>キャンセル</flux:button>
    <flux:button type="submit" variant="primary">登録する</flux:button>
</div>
