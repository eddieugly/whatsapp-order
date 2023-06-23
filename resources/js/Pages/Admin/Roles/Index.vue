

<template>
    <Head title="Roles List" />

    <AuthenticatesLayout>

        <Section>
            <Card>
                <Addbutton :href="route('admin.roles.create')">
                    Add Roles
                </Addbutton>

                <Table :headers="headers" :items="roles">
                    <template v-slot="{ item }">
                        <Td>
                            {{ item.name }}
                        </Td>

                        <Td>
                            {{ item.created_at_formatted }}
                        </Td>
                        <Td class="flex items-center">
                            <Actions :edit-link="route('admin.roles.edit', {id: item.id})" :drop-key="item.id" />
                        </Td>
                    </template>
                </Table>

                <Pagination :link="roles.links" />
            </Card>

        </Section>


    </AuthenticatesLayout>
</template>
<script setup>
import AuthenticatesLayout from '@/Layouts/AuthenticatesLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import Pagination from '@/Components/Pagination.vue';
import Section from '@/Components/Section.vue';
import Card from '@/Components/Card/Card.vue'
import Table from '@/Components/Table/Table.vue';
import Td from '@/Components/Table/Td.vue';
import Actions from '@/Components/Table/Actions.vue';
import Addbutton from '@/Components/Table/Addbutton.vue';

defineProps({
    roles: {
        type: Object,
        default: () => [],
    },
    headers: {
        type: Object,
        default: () => [],
    },
});


</script>