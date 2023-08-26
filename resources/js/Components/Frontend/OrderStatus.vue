<template>
  <div v-if="statuses == 1" class="w-full py-6">
    <div class="flex">
      <div class="w-1/3">
        <div class="relative mb-2">
          <div class="w-10 h-10 mx-auto bg-green-500 rounded-full text-lg text-white flex items-center">
            <span class="text-center text-white w-full">
              <CheckoutOrderIcon />
            </span>
          </div>
        </div>

        <div class="text-xs text-center md:text-base">Order</div>
      </div>

      <div class="w-1/3">
        <div class="relative mb-2">
          <div class="absolute flex align-center items-center align-middle content-center"
            style="width: calc(100% - 2.5rem - 1rem); top: 50%; transform: translate(-50%, -50%)">
            <div class="w-full bg-gray-200 rounded items-center align-middle align-center flex-1">
              <div class="w-0 bg-green-400 py-1 rounded" style="width: 100%;"></div>
            </div>
          </div>

          <div class="w-10 h-10 mx-auto bg-green-500 rounded-full text-lg text-white flex items-center">
            <span class="text-center text-white w-full">
              <CheckoutProcessIcon />
            </span>
          </div>
        </div>

        <div class="text-xs text-center md:text-base">Processing</div>
      </div>

      <div class="w-1/3">
        <div class="relative mb-2">
          <div class="absolute flex align-center items-center align-middle content-center"
            style="width: calc(100% - 2.5rem - 1rem); top: 50%; transform: translate(-50%, -50%)">
            <div class="w-full bg-gray-200 rounded items-center align-middle align-center flex-1">
              <div class="w-0 bg-green-400 py-1 rounded" style="width: 45%;"></div>
            </div>
          </div>

          <div class="w-10 h-10 mx-auto bg-white border-2 border-gray-200 rounded-full text-lg text-white flex items-center">
            <span class="text-center text-gray-600 w-full dark:text-white">
              <CheckoutCompleteIcon />
            </span>
          </div>
        </div>

        <div class="text-xs text-center md:text-base">Completed</div>
      </div>
    </div>
  </div>

  <div v-if="statuses == 3" class="w-full py-6">
    <div class="flex justify-center">
      <div class="w-1/3">
        <div class="relative mb-2">
          <div class="w-10 h-10 mx-auto bg-green-500 rounded-full text-lg text-white flex items-center">
            <span class="text-center text-white w-full">
              <CheckoutOrderIcon />
            </span>
          </div>
        </div>

        <div class="text-xs text-center md:text-base">Order</div>
      </div>

      <div class="w-1/3">
        <div class="relative mb-2">
          <div class="absolute flex align-center items-center align-middle content-center"
            style="width: calc(100% - 2.5rem - 1rem); top: 50%; transform: translate(-50%, -50%)">
            <div class="w-full bg-gray-200 rounded items-center align-middle align-center flex-1">
              <div class="w-0 bg-green-400 py-1 rounded" style="width: 100%;"></div>
            </div>
          </div>

          <div class="w-10 h-10 mx-auto bg-green-500 rounded-full text-lg text-white flex items-center">
            <span class="text-center text-white w-full">
              <CheckoutProcessIcon />
            </span>
          </div>
        </div>

        <div class="text-xs text-center md:text-base">Processed</div>
      </div>
      <div class="w-1/3">
        <div class="relative mb-2">
          <div class="absolute flex align-center items-center align-middle content-center"
            style="width: calc(100% - 2.5rem - 1rem); top: 50%; transform: translate(-50%, -50%)">
            <div class="w-full bg-gray-200 rounded items-center align-middle align-center flex-1">
              <div class="w-0 bg-green-400 py-1 rounded" style="width: 100%;"></div>
            </div>
          </div>

          <div class="w-10 h-10 mx-auto bg-green-500 rounded-full text-lg text-white flex items-center">
            <span class="text-center text-white w-full">
              <CheckoutCompleteIcon />
            </span>
          </div>
        </div>

        <div class="text-xs text-center md:text-base">Completed</div>
      </div>
    </div>
  </div>
</template>

<script setup>
import CheckoutCompleteIcon from './Icon/CheckoutCompleteIcon.vue';
import CheckoutOrderIcon from './Icon/CheckoutOrderIcon.vue';
import CheckoutProcessIcon from './Icon/CheckoutProcessIcon.vue';


const props = defineProps({
  statuses: {
    type: Number,
  },
});
</script>
