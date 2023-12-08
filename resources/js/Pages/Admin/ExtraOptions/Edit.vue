<script setup>
import AuthenticatesLayout from '@/Layouts/AuthenticatesLayout.vue';
import { Head } from '@inertiajs/vue3';
import { Input, Button } from 'flowbite-vue';
import { useForm } from '@inertiajs/vue3';
import Card from '@/Components/Card/Card.vue';
import ToogleGroup from '@/Components/ToogleGroup.vue';
import SelectGroup from '@/Components/SelectGroup.vue';

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
        default: () => ({}),
    },
    edit: {
        type: Boolean,
        default: false,
    },
    extras: {
        type: Array,
    },
});

const form = useForm({
    extra_id: props.item.extras.id,
    name: props.item.name,
    price: `${props.item.price}`,
});

const submit = () => {
    form.put(route(`admin.${props.routeResourceName}.update`, { id: props.item.id }), {
        _method: 'put',
    });
};
</script>

<template>
    <Head :title="title" />

    <AuthenticatesLayout>
        <Card>
            <div class="items-center p-5 sm:p-8 lg:p-10 mx-auto ">
                <h5 class="text-xl font-medium text-gray-900 dark:text-white mb-5">{{ title }}</h5>
                <form @submit.prevent="submit">

                    <div class="mb-4">
                        <SelectGroup label="Extras" v-model="form.extra_id" :items="extras"
                                :error-message="form.errors.extra_id" select-value="Select Extras" required />
                    </div>

                    <div class="mb-4">
                        <Input v-model="form.name" name="name" id="name" placeholder="Enter Name" label="Name">
                        <template #helper v-if="form.errors.name" class="text-red-500">
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ form.errors.name }}</p>
                        </template>
                        </Input>
                    </div>

                    <div class="mb-4">
                        <Input v-model="form.price" name="price" id="price" type="numeric" pattern="[0-9]*" placeholder="Enter Options Price" 
                                label="Options Price">
                            <template #helper v-if="form.errors.price">
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ form.errors.price }}</p>
                            </template>
                        </Input>
                    </div>

                    <div class="mb-4">
                        <Button color="default" type="submit" :disabled="form.processing">Submit</Button>
                    </div>
                </form>
            </div>
        </Card>
    </AuthenticatesLayout>
</template>
