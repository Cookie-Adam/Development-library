<x-field name="name" label="Name" :value="$client?->name" required />
<x-field name="email" label="Email" type="email" :value="$client?->email" />
<x-field name="phone" label="Phone" :value="$client?->phone" />
<x-field name="card_number" label="Card number" :value="$client?->card_number" required />
