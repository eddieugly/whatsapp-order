import { ref, watch, computed } from "vue";
import { router } from '@inertiajs/vue3';

export default function (params) {
  const { filters: defaultFilters, routeName } = params;

  const filters = ref(defaultFilters);

  const isFilled = computed(() => {
    let { page, ...rest } = filters.value;

    return Object.values(rest)
      .some(v => !["", null, undefined].includes(v))
  })
  
  const fetchItemsHandler = ref(null);

  function fetchItems() {
    router.get(routeName, {
      ...filters.value,
    }, {
      preserveState: true,
      preserveScroll: true,
      replace: true,
    });
  }

  watch(
    filters,
    () => {
      clearTimeout(fetchItemsHandler.value);

      fetchItemsHandler.value = setTimeout(() => {
        fetchItems();
      }, 300);
    },
    {
      deep: true,
    }
  );

  return {
    filters,
    isFilled,
  }
}