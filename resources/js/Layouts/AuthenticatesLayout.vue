<script setup>
import DashnavVue from '@/Components/Dashnav.vue';
import SiderbarVue from '@/Components/Siderbar.vue';
import { onMounted } from 'vue';
import { initFlowbite } from 'flowbite';
import Alert from '@/Components/Alert.vue';


onMounted(() => {
    initFlowbite();
})
</script>

<template>
    <div>
        <div class="antialiased min-h-screen bg-gray-50 dark:bg-gray-900">
            <!-- Dashboard SideBar -->
            <DashnavVue />

            <!-- Dashboard SideBar -->
            <SiderbarVue />

            <!-- Page Content -->
            <main class="p-4 md:ml-64 h-auto pt-20">

                <slot />
            </main>
            <Alert />

        </div>
    </div>
</template>
