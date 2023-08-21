<script setup>
import { computed } from "vue";
import { Link } from "@inertiajs/vue3";
import Action from "@/Components/Icons/Action.vue";

defineProps({
  editLink: {
    type: String,
    default: () => "",
  },
  showEdit: {
    type: Boolean,
    default: () => true,
  },
  showDelete: {
    type: Boolean,
    default: () => true,
  },
});

const dropId = computed(() => {
  let id = "dropdown-button-" + parseInt(Math.random() * 10000000).toString();
  return id;
});
const dripEd = computed(() => {
  let id = "dropdown-" + parseInt(Math.random() * 10000000).toString();
  return id;
});

const emits = defineEmits(["deleteClicked"]);
</script>

<template>
  <button
    :id="dropId"
    :data-dropdown-toggle="dripEd"
    :data-dropdown-targer="dripEd"
    class="inline-flex items-center p-0.5 text-sm font-medium text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none dark:text-gray-400 dark:hover:text-gray-100"
  >
    <Action class="w-5 h-5" />
  </button>
  <div
    :id="dripEd"
    class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600"
  >
    <ul
      v-if="showEdit"
      class="py-1 text-sm text-gray-700 dark:text-gray-200"
      :aria-labelledby="dropId"
    >
      <li>
        <Link
          :href="editLink"
          class="block w-full text-left py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
        >
          Edit
        </Link>
      </li>
    </ul>
    <div v-if="showDelete" class="py-1">
      <button
        href=""
        @click="$emit('deleteClicked', $event)"
        as="button"
        class="block w-full text-left py-2 px-4 text-sm text-red-700 hover:bg-red-100 dark:hover:bg-gray-600 dark:text-red-400 dark:hover:text-white"
      >
        Delete
      </button>
    </div>
  </div>
</template>
