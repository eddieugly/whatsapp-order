<script setup>
import { usePage, useForm } from '@inertiajs/vue3';
import { Input, Button } from 'flowbite-vue';
import Card from '@/Components/Card/Card.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import Select2 from '@/Components/Select2.vue';
import TextAreaGroup from '@/Components/TextAreaGroup.vue';

const props = defineProps({
  generalId: String
});

const form = useForm({
  generalId: props.generalId,
  company_logo_white: null,
  company_logo_dark: null,
  company_favicon: null,
  company_seo: null,
});

const update = () => {
  form.post(route('admin.settings.update.logo'), {
    forceFormData: true,
  });
};


</script>

<template>
  <Card>
    <div class="items-center p-5 sm:p-8 lg:p-10 mx-auto max-w-2xl rounded">
      <form @submit.prevent="update">
        <div class="grid gap-4 sm:grid-cols-2">

          <div class="mb-4 sm:col-span-2">
            <Input @input="form.company_logo_white = $event.target.files[0]" type="file" name="company_logo_white"
              id="company_logo_white" label="Company Logo White">
            <template #helper>
              <small>Image will be resized into 500x500 px. Supported Files: .jpg, .png, .jpeg,
                .webp.</small>
              <p v-if="form.errors.company_logo_white" class="mt-2 text-sm text-red-600 dark:text-red-500">{{
                form.errors.company_logo_white }}</p>
            </template>
            </Input>
          </div>

          <div class="mb-4 sm:col-span-2">
            <Input @input="form.company_logo_dark = $event.target.files[0]" type="file" name="company_logo_dark"
              id="company_logo_dark" label="Company Logo Dark">
            <template #helper>
              <small>Image will be resized into 500x500 px. Supported Files: .jpg, .png, .jpeg,
                .webp.</small>
              <p v-if="form.errors.company_logo_dark" class="mt-2 text-sm text-red-600 dark:text-red-500">{{
                form.errors.company_logo_dark }}</p>
            </template>
            </Input>
          </div>
          
          <div class="mb-4 sm:col-span-2">
            <Input @input="form.company_favicon = $event.target.files[0]" type="file" name="company_favicon"
              id="company_favicon" label="Company FavIcon">
            <template #helper>
              <small>Image will be resized into 500x500 px. Supported Files: .jpg, .png, .jpeg,
                .webp.</small>
              <p v-if="form.errors.company_favicon" class="mt-2 text-sm text-red-600 dark:text-red-500">{{
                form.errors.company_favicon }}</p>
            </template>
            </Input>
          </div>

          <div class="mb-4 sm:col-span-2">
            <Input @input="form.company_seo = $event.target.files[0]" type="file" name="company_seo"
              id="company_seo" label="Company SEO">
            <template #helper>
              <small>Image will be resized into 600x315 px. Supported Files: .jpg, .png, .jpeg,
                .webp.</small>
              <p v-if="form.errors.company_seo" class="mt-2 text-sm text-red-600 dark:text-red-500">{{
                form.errors.company_seo }}</p>
            </template>
            </Input>
          </div>
          
        </div>
        <div class="my-5">
          <Button class="w-full" color="default" type="submit" :disabled="form.processing">Update Logo</Button>
        </div>
      </form>
    </div>
  </Card>
</template>
