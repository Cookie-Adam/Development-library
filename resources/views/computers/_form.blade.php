<x-field name="name" label="Name (e.g. PC-01)" :value="$computer?->name" required />
<x-select name="status" label="Status" :selected="$computer?->status ?? 'available'"
          :options="['available' => 'Available', 'in_use' => 'In use', 'maintenance' => 'Maintenance']" />
