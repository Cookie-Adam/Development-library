<x-field name="title" label="Title" :value="$book?->title" required />
<x-field name="author" label="Author" :value="$book?->author" required />
<x-field name="isbn" label="ISBN" :value="$book?->isbn" />
<x-field name="category" label="Category" :value="$book?->category" />
<x-field name="copies" label="Total copies" type="number" min="1" :value="$book?->copies ?? 1" required />
@if ($book)
    <x-field name="available_copies" label="Available copies" type="number" min="0" :value="$book->available_copies" />
@endif
