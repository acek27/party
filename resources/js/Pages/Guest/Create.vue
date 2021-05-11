<template>
  <div>
    <h1 class="mb-8 font-bold text-3xl">
      <inertia-link class="text-indigo-400 hover:text-indigo-600" :href="route('guest.index')">Tamu</inertia-link>
      <span class="text-indigo-400 font-medium">/</span> Data Baru
    </h1>
    <div class="bg-white rounded-md shadow overflow-hidden max-w-3xl">
      <form @submit.prevent="store">
        <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
          <text-input v-model="form.name" :error="form.errors.name" class="pr-6 pb-8 w-full lg:w-1/2" label="Nama Tamu" />
          <number-input v-model="form.money" :error="form.errors.money" class="pr-6 pb-8 w-full lg:w-1/2" type="number" label="Uang" />
          <number-input v-model="form.rice" :error="form.errors.rice" class="pr-6 pb-8 w-full lg:w-1/2" type="number" label="Beras" />
          <number-input v-model="form.sugar" :error="form.errors.sugar" class="pr-6 pb-8 w-full lg:w-1/2" type="number" label="Gula" />
          <textarea-input v-model="form.address" :error="form.errors.address" class="pr-6 pb-8 w-full lg:w-1/2" label="Alamat" />
          <textarea-input v-model="form.other" :error="form.errors.other" class="pr-6 pb-8 w-full lg:w-1/2" label="Lainnya" />
          <select-input v-model="form.detail_id" :error="form.errors.detail_id" class="pr-6 pb-8 w-full lg:w-1/2" label="Keterangan">
            <option :value="1">Baru</option>
            <option :value="2">Kembali</option>
          </select-input>
        </div>
        <div class="px-8 py-4 bg-gray-50 border-t border-gray-100 flex justify-end items-center">
          <inertia-link class="btn-indigo mr-auto" :href="route('users')">
            Kembali
          </inertia-link>
          <loading-button :loading="form.processing" class="btn-indigo" type="submit">Create User</loading-button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import Layout from '@/Shared/Layout'
import TextInput from '@/Shared/TextInput'
import TextareaInput from '@/Shared/TextareaInput'
import SelectInput from '@/Shared/SelectInput'
import LoadingButton from '@/Shared/LoadingButton'
import NumberInput from "../../Shared/NumberInput";

export default {
  metaInfo: { title: 'Create User' },
  components: {
      NumberInput,
    LoadingButton,
    SelectInput,
    TextInput,
    TextareaInput,
  },
  layout: Layout,
  remember: 'form',
  data() {
    return {
      form: this.$inertia.form({
        name: null,
        address: null,
        money: 0,
        rice: 0,
        sugar: 0,
        other: null,
        detail_id: 1,
      }),
    }
  },
  methods: {
    store() {
      this.form.post(this.route('guest  .store'))
    },
  },
}
</script>
