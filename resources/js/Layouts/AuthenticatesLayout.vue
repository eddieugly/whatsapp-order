<script setup>
import DashnavVue from '@/Components/Dashnav.vue';
import SiderbarVue from '@/Components/Siderbar.vue';
import { onMounted } from 'vue';
import { initFlowbite } from 'flowbite';
import ToastList from '@/Components/ToastList.vue';
import Alert from '@/Components/Alert.vue';


onMounted(() => {
  initFlowbite();
})
</script>

<template>
    <div>
        <div class="min-h-screen bg-gray-100">
            <DashnavVue />
            

            <SiderbarVue />

            <!-- Page Content -->
            <main>
                
                <slot />
            </main>
            <Alert />
            
        </div>
    </div>
</template>
