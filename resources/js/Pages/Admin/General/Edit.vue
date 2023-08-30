<script setup>
import { watch } from 'vue';
import AuthenticatesLayout from '@/Layouts/AuthenticatesLayout.vue';
import { Head, usePage } from '@inertiajs/vue3';
import { Input, Button } from 'flowbite-vue';
import { useForm, router } from '@inertiajs/vue3';
import Card from '@/Components/Card/Card.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import Select2 from '@/Components/Select2.vue';
import TextAreaGroup from '@/Components/TextAreaGroup.vue';
import Logo from './Logo.vue';

const props = defineProps({
  
  title: {
    type: String,
    required: true,
  },
  item: {
    type: Object,
  },
});

const form = useForm({
  generalId: props.item.id,
  company_name: props.item.company_name,
  company_tagline: props.item.company_tagline,
  company_abbrevation: props.item.company_abbrevation,
  company_description: props.item.company_description,
  company_phone: props.item.company_phone,
  company_email: props.item.company_email,
  company_address: props.item.company_address,
  company_seo_description: props.item.company_seo_description,
  company_seo_keywords: props.item.company_seo_keywords,
  company_footer_text: props.item.company_footer_text,
  facebook: props.item.facebook,
  twitter: props.item.twitter,
  instagram: props.item.instagram,
});

const submit = () => {
  form.post(route('admin.settings.update'), {
    forceFormData: true,
  });
};
</script>

<template>
  <Head :title="title" />

  <AuthenticatesLayout>
    <Card>
      <div class="items-center p-5 sm:p-8 lg:p-10 mx-auto max-w-2xl rounded">
        <form @submit.prevent="submit">
          <div class="grid gap-4 sm:grid-cols-2">

            <div class="mb-4">
              <Input v-model="form.company_name" name="company_name" id="company_name" placeholder="Company Name" label="Company Name"
                required>
              <template #helper v-if="form.errors.company_name" class="text-red-500">
                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ form.errors.company_name }}</p>
              </template>
              </Input>
            </div>
            <div class="mb-4">
              <Input v-model="form.company_tagline" name="company_tagline" id="company_tagline" placeholder="Company TagLine" label="Company TagLine">
              <template #helper v-if="form.errors.company_tagline" class="text-red-500">
                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ form.errors.company_tagline }}</p>
              </template>
              </Input>
            </div>

            <div class="mb-4">
              <Input v-model="form.company_abbrevation" name="company_abbrevation" id="company_abbrevation" placeholder="Company Abbrevation" label="Company Abbrevation"
                required>
              <template #helper v-if="form.errors.company_abbrevation" class="text-red-500">
                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ form.errors.company_abbrevation }}</p>
              </template>
              </Input>
            </div>
            <div class="mb-4">
              <Input v-model="form.company_phone" name="company_phone" id="company_phone" placeholder="Company Phone" label="Company Phone"
                required>
              <template #helper v-if="form.errors.company_phone" class="text-red-500">
                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ form.errors.company_phone }}</p>
              </template>
              </Input>
            </div>

            <div class="mb-4 sm:col-span-2">
              <TextAreaGroup label="Company Description" :error-message="form.errors.company_description" v-model="form.company_description" />
            </div>
            
            <div class="mb-4">
              <Input v-model="form.company_email" type="email" name="company_email" id="company_email" placeholder="Company Email" label="Company Email">
              <template #helper v-if="form.errors.company_email" class="text-red-500">
                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ form.errors.company_email }}</p>
              </template>
              </Input>
            </div>
            <div class="mb-4">
              <Input v-model="form.company_address" name="company_address" id="company_address" placeholder="Company Address" label="Company Address"
                required>
              <template #helper v-if="form.errors.company_address" class="text-red-500">
                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ form.errors.company_address }}</p>
              </template>
              </Input>
            </div>

            <div class="mb-4 sm:col-span-2">
              <TextAreaGroup label="Company SEO Description" :error-message="form.errors.company_seo_description" v-model="form.company_seo_description" />
            </div>

            <div class="mb-4 sm:col-span-2">
              <InputLabel class="mb-2" value="Company SEO KeyWord" />
              <Select2 tokenizer="tokenizer" v-model="form.company_seo_keywords" :options="item.company_seo_keywords" :settings="{ data: item.company_seo_keywords, multiple: true, tags: true }" />
              <InputError v-if="form.errors.company_seo_keywords" :message="form.errors.company_seo_keywords" />
            </div>


            <div class="mb-4">
              <Input v-model="form.company_footer_text" name="company_footer_text" id="company_footer_text" placeholder="Company Footer Text" label="Company Footer Text">
              <template #helper v-if="form.errors.company_footer_text" class="text-red-500">
                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ form.errors.company_footer_text }}</p>
              </template>
              </Input>
            </div>

            <div class="mb-4">
              <Input v-model="form.facebook" name="facebook" id="facebook" placeholder="Company Facebook Link" label="Company Facebook Link"
                required>
              <template #helper v-if="form.errors.facebook" class="text-red-500">
                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ form.errors.facebook }}</p>
              </template>
              </Input>
            </div>
            <div class="mb-4">
              <Input v-model="form.twitter" name="twitter" id="twitter" placeholder="Company Twitter Link" label="Company Twitter Link">
              <template #helper v-if="form.errors.twitter" class="text-red-500">
                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ form.errors.twitter }}</p>
              </template>
              </Input>
            </div>

            <div class="mb-4">
              <Input v-model="form.instagram" name="instagram" id="instagram" placeholder="Company Instagram Link" label="Company Instagram Link"
                required>
              <template #helper v-if="form.errors.instagram" class="text-red-500">
                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ form.errors.instagram }}</p>
              </template>
              </Input>
            </div>

            
          </div>
          <div class="my-5">
            <Button class="w-full" color="default" type="submit" :disabled="form.processing">Update</Button>
          </div>
        </form>
      </div>
    </Card>

    <Logo :general-id="item.id" class="mt-10" />
  </AuthenticatesLayout>
</template>
