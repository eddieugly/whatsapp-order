<template>
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 p-5">
    <div class="col-span-1">
      <Input v-model="filters.id" placeholder="Order ID">
        <template #prefix>
          <Search class="w-5 h-5" />
        </template>
      </Input>
    </div>

    <div class="col-span-1">
      <Input v-model="filters.name" placeholder="Customer Name">
        <template #prefix>
          <Search class="w-5 h-5" />
        </template>
      </Input>
    </div>

    <div class="col-span-1">
      <Input v-model="filters.email" placeholder="Customer Email">
        <template #prefix>
          <Search class="w-5 h-5" />
        </template>
      </Input>
    </div>

    <div class="col-span-1">
      <Input v-model="filters.phone" placeholder="Customer Phone">
        <template #prefix>
          <Search class="w-5 h-5" />
        </template>
      </Input>
    </div>

    <div class="col-span-1 md:col-full">
      <SelectGroup
        v-model="filters.payment_status"
        :items="[
          { id: 0, name: 'Failed' },
          { id: 1, name: 'Pending' },
          { id: 2, name: 'Paid' },
        ]"
        select-value="Payment Status"
      />
    </div>

    <div class="col-span-1 md:col-full">
      <SelectGroup
        v-model="filters.payment_method"
        :items="[
          { id: 0, name: 'Pay on Pickup' },
          { id: 1, name: 'Pay Now' },
        ]"
        select-value="Payment Method"
      />
    </div>

    <div class="col-span-1 md:col-full">
      <SelectGroup
        v-model="filters.order_status"
        :items="[
          { id: 0, name: 'Cancelled' },
          { id: 1, name: 'Pending' },
          { id: 2, name: 'Completed' },
          { id: 3, name: 'Picked' },
        ]"
        select-value="Order Status"
      />
    </div>
  </div>
</template>

<script setup>
import { Link, router } from "@inertiajs/vue3";
import { ref, watch } from "vue";
import SelectGroup from "@/Components/SelectGroup.vue";
import { Input } from "flowbite-vue";
import Search from "@/Components/Icons/Search.vue";

const props = defineProps({
  modelValue: {
    type: Object,
    default: () => ({}),
  },
  canCreate: {
    type: Boolean,
    default: () => true,
  },
});

const emits = defineEmits(["update:modelValue"]);

const filters = ref({ ...props.modelValue });

watch(
  filters,
  () => {
    emits("update:modelValue", filters.value);
  },
  {
    deep: true,
  }
);
</script>
