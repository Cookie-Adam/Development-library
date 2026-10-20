<x-field name="name" label="Name" :value="$member?->name" required />
<x-field name="email" label="Email" type="email" :value="$member?->email" required />
<x-field name="phone" label="Phone" :value="$member?->phone" />
<x-field name="role" label="Role" :value="$member?->role ?? 'librarian'" required />
