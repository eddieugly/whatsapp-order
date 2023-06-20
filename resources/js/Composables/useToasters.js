import {ref} from "vue";

export default function useToasters() {
    const toasts = ref([]);
  
    const showToast = (message, type, timer) => {
      const toast = {
        message,
        type,
        timer,
      };
      toasts.push(toast);
    };
  
    return {
      toasts,
      showToast,
    };
  };