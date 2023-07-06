<script setup>
import InputLabel from "./InputLabel.vue";
import Select from "@/Components/Select.vue";
import InputError from "@/Components/InputError.vue";

defineProps({
    modelValue: {},
    items: Array,
    itemText: {
        type: String,
        default: "name",
    },
    itemValue: {
        type: String,
        default: "id",
    },
    withoutSelect: {
        type: Boolean,
        default: false,
    },
    label: {
        type: String,
        default: "",
    },
    errorMessage: {
        type: String,
        default: "",
    },
    selectValue: {
        type: String,
        default: "Select"
    }
});
</script>

<template>
    <div>
        <InputLabel class="mb-2" v-if="label" :value="label" />

        <Select :model-value="modelValue" @update:model-value="$emit('update:modelValue', $event)" :items="items"
            :item-text="itemText" :item-value="itemValue" :select-value="selectValue" :without-select="withoutSelect" v-bind="$attrs" />

        <InputError v-if="errorMessage" class="mt-1" :message="errorMessage" />
    </div>
</template>