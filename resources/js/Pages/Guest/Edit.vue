<template>
  <div>
    <div class="mb-8 flex justify-start max-w-3xl">
      <h1 class="font-bold text-3xl">
        <inertia-link class="text-indigo-400 hover:text-indigo-600" :href="route('guest.index')">Tamu</inertia-link>
        <span class="text-indigo-400 font-medium">/</span>
        {{ form.name }}
      </h1>
    </div>
    <trashed-message v-if="guest.deleted_at" class="mb-6" @restore="restore">
      This user has been deleted.
    </trashed-message>
    <div class="bg-white rounded-md shadow overflow-hidden max-w-3xl">
      <form @submit.prevent="update">
        <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
          <text-input v-model="form.name" :error="form.errors.name" class="pr-6 pb-8 w-full lg:w-1/2" label="Nama Tamu" />
          <number-input v-model="form.money" :error="form.errors.money" class="pr-6 pb-8 w-full lg:w-1/2" label="Uang" />
          <number-input v-model="form.rice" :error="form.errors.rice" class="pr-6 pb-8 w-full lg:w-1/2" label="Beras" />
          <number-input v-model="form.sugar" :error="form.errors.sugar" class="pr-6 pb-8 w-full lg:w-1/2" label="Gula" />
          <textarea-input v-model="form.address" :error="form.errors.address" class="pr-6 pb-8 w-full lg:w-1/2" label="Alamat" />
          <textarea-input v-model="form.other" :error="form.errors.other" class="pr-6 pb-8 w-full lg:w-1/2" label="Lainnya" />
          <select-input v-model="form.detail_id" :error="form.errors.detail_id" class="pr-6 pb-8 w-full lg:w-1/2" label="Keterangan">
            <option :value="1">Baru</option>
            <option :value="2">Kembali</option>
          </select-input>
        </div>
        <div class="px-8 py-4 bg-gray-50 border-t border-gray-100 flex justify-end items-center">
          <button v-if="!guest.deleted_at" class="text-red-600 hover:underline mr-auto" tabindex="-1" type="button" @click="destroy">Delete User</button>
          <inertia-link class="btn-indigo mr-3" :href="route('guest.index')">
            Kembali
          </inertia-link>
          <loading-button :loading="form.processing" class="btn-indigo" type="submit">Update User</loading-button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import Layout from '@/Shared/Layout'
import TextInput from '@/Shared/TextInput'
import SelectInput from '@/Shared/SelectInput'
import TextareaInput from '@/Shared/TextareaInput'
import LoadingButton from '@/Shared/LoadingButton'
import TrashedMessage from '@/Shared/TrashedMessage'
import NumberInput from '../../Shared/NumberInput'

export default {
  metaInfo() {
    return {
      title: `${this.form.name}`,
    }
  },
  components: {
    NumberInput,
    LoadingButton,
    SelectInput,
    TextInput,
    TextareaInput,
    TrashedMessage,
  },
  layout: Layout,
  props: {
    guest: Object,
  },
  remember: 'form',
  data() {
    return {
      form: this.$inertia.form({
        _method: 'put',
        name: this.guest.name,
        address: this.guest.address,
        money: this.guest.money,
        rice: this.guest.rice,
        sugar: this.guest.sugar,
        other: this.guest.other,
        detail_id: this.guest.detail_id,
      }),
    }
  },
  methods: {
    update() {
      this.form.post(this.route('guest.update', this.guest.id), {
      })
    },
    destroy() {
      if (confirm('Are you sure you want to delete this user?')) {
        this.$inertia.delete(this.route('guest.destroy', this.guest.id))
      }
    },
    restore() {
      if (confirm('Are you sure you want to restore this user?')) {
        this.$inertia.put(this.route('guest.restore', this.guest.id))
      }
    },
  },
}
</script>
