<script setup>
import { watch } from "vue";
import AuthenticatesLayout from "@/Layouts/AuthenticatesLayout.vue";
import { Head } from "@inertiajs/vue3";
import { Input, Button } from "flowbite-vue";
import { useForm, router } from "@inertiajs/vue3";
import kebabCase from "lodash/kebabCase";
import replace from "lodash/replace";
import ToogleGroup from "@/Components/ToogleGroup.vue";
import Card from "@/Components/Card/Card.vue";
import SelectGroup from "@/Components/SelectGroup.vue";
import ImageUpload from "@/Components/ImageUpload.vue";
import Close from "@/Components/Icons/Close.vue";
import { QuillEditor } from "@vueup/vue-quill";
import "@vueup/vue-quill/dist/vue-quill.snow.css";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";

let props = defineProps({
  routeResourceName: {
    type: String,
    required: true,
  },
  title: {
    type: String,
    required: true,
  },
  item: {
    type: Object,
  },
});

const form = useForm({
  _method: "PATCH",
  customer_name: props.item.customer_name,
  customer_email: props.item.customer_email,
  customer_phone: props.item.customer_phone,
  order_status: `${props.item.order_status}`,
  payment_status: `${props.item.payment_status}`,
});

const submit = () => {
  form.post(route(`admin.${props.routeResourceName}.update`, { id: props.item.id }), {
    forceFormData: true,
  });
};
</script>

<template>
  <Head :title="title" />

  <AuthenticatesLayout>
    <Card>
      <h5 class="p-5 text-2xl border-b-2 font-semibold tracking-tight text-gray-900 dark:text-white">
        Update Order
      </h5>

      <div class="items-center p-5 sm:p-8 lg:p-10 mx-auto max-w-2xl rounded md:border my-4">
        <div class="inline-flex items-center justify-center w-full text-lg font-semibold">
          Order Items
        </div>
        <div class="flow-root">
          <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
            <li v-for="order in item.cart" :key="order.id" class="py-3 sm:py-4">
              <div class="flex items-center space-x-4">
                <div class="flex-1 min-w-0">
                  <p class="text-base font-medium text-gray-900 truncate dark:text-white">
                    {{ order.name }}
                  </p>
                  <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                    ₦{{ order.price.toLocaleString() }}
                  </p>
                  <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                    <small>#{{ order.id }}</small>
                  </p>
                </div>
                <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                  x {{ order.quantity }}
                </div>
              </div>
            </li>
          </ul>
        </div>
      </div>



      <div class="items-center p-5 sm:p-8 lg:p-10 mx-auto max-w-2xl rounded md:border my-4">
        <form @submit.prevent="submit">
          <div class="grid gap-4 sm:grid-cols-2">
            <div class="mb-4">
              <Input v-model="form.customer_name" placeholder="Customer Name" label="Customer Name" required>
              <template #helper v-if="form.errors.customer_name" class="text-red-500">
                <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                  {{ form.errors.customer_name }}
                </p>
              </template>
              </Input>
            </div>
            <div class="mb-4">
              <Input v-model="form.customer_email" type="email" placeholder="Customer Email" label="Customer Email">
              <template #helper v-if="form.errors.customer_email" class="text-red-500">
                <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                  {{ form.errors.customer_email }}
                </p>
              </template>
              </Input>
            </div>
            <div class="mb-4">
              <Input v-model="form.customer_phone" type="numeric" pattern="[0-9]*" placeholder="Customer Phone"
                label="Customer Phone">
              <template #helper v-if="form.errors.customer_phone">
                <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                  {{ form.errors.customer_phone }}
                </p>
              </template>
              </Input>
            </div>
            <div class="mb-4">
              <SelectGroup label="Order Status" v-model="form.order_status" :items="[
                { id: 0, name: 'Cancelled' },
                { id: 1, name: 'Pending' },
                { id: 2, name: 'Completed' },
                { id: 3, name: 'Picked' },
              ]" :error-message="form.errors.order_status" select-value="Update Order" required />
            </div>
            <div class="mb-4">
              <SelectGroup label="Payment Status" v-model="form.payment_status" :items="[
                { id: 0, name: 'Cancelled' },
                { id: 1, name: 'Pending' },
                { id: 2, name: 'Paid' },
              ]" :error-message="form.errors.payment_status" select-value="Update Payment" required />
            </div>
          </div>

          <div class="my-5">
            <Button class="w-full" color="default" type="submit" :disabled="form.processing">Submit</Button>
          </div>
        </form>
      </div>
    </Card>
  </AuthenticatesLayout>
</template>
