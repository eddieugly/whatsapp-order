<template>
  <AuthenticatesLayout>
    <Section>
      <Card>
        <h5 class="text-xl p-5 font-medium text-gray-900 dark:text-white mb-5">Permissions</h5>
        <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
          <div class="w-full md:w-1/2">
            <div class="flex items-center">
              <label for="simple-search" class="sr-only">Search</label>
              <div class="relative w-full">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                  <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                    viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                      d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                      clip-rule="evenodd" />
                  </svg>
                </div>
                <input v-model="search" type="text" id="simple-search"
                  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                  placeholder="Search..." name="search">
              </div>
            </div>
          </div>
        </div>

        <ListGroup class="w-full">
          <ListGroupItem v-for="(permission, index) in filteredPermissions"
          :key="permission.id"
          class="flex items-center justify-between">
            <template #suffix>
              <Button v-if="roleHasPermission(permission)" @click="detachPermission(permission)" color="green">
                Detach
              </Button>
              <Button v-else @click="attachPermission(permission)" color="dark">
                Attach
              </Button>
            </template>
            <div :class="{'text-green-700 font-bold' : roleHasPermission(permission)}">{{ permission.name }}</div>
          </ListGroupItem>
        </ListGroup>


      </Card>
    </Section>
  </AuthenticatesLayout>
</template>

<script setup>
import { ref, computed } from 'vue';
import AuthenticatesLayout from '@/Layouts/AuthenticatesLayout.vue';
import Section from '@/Components/Section.vue';
import Card from '@/Components/Card/Card.vue';
import { router } from '@inertiajs/vue3';
import { ListGroup, ListGroupItem, Button } from 'flowbite-vue';

const props = defineProps({
  role: {
        type: Object,
        default: () => {
            permissions: [];
        },
    },
  permissions: {
    type: Array,
  }
});

const search = ref("");

const filteredPermissions = computed(() => {
  return props.permissions.filter((p) =>
    p.name.toLowerCase().includes(search.value.toLowerCase())
  );
});

const roleHasPermission = (permission) => {
  return props.role.permissions.some((p) => p.id == permission.id);
};

const attachPermission = (permission) => {
  router.post(
    route("admin.roles.attach-permission"),
    {
      roleId: props.role.id,
      permissionId: permission.id,
    },
    {
      preserveScroll: true,
      preserveState: true,
    }
  );
};

const detachPermission = (permission) => {
  router.post(
    route("admin.roles.detach-permission"),
    {
      roleId: props.role.id,
      permissionId: permission.id,
    },
    {
      preserveScroll: true,
      preserveState: true,
    }
  );
};

</script>

<style lang="scss" scoped></style>