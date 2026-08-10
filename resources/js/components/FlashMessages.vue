<script setup lang="ts">
import { usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

const page = usePage();

const success = computed(() => page.props.flash.success);
const error = computed(() => page.props.flash.error);
</script>

<template>
    <div v-if="success || error" class="mx-auto w-full max-w-6xl px-6 pt-6">
        <p
            v-if="success"
            class="rounded-cozy border border-pine-light/30 bg-pine-light/10 px-5 py-3 text-sm font-medium text-pine"
        >
            {{ success }}
        </p>
        <p
            v-if="error"
            class="rounded-cozy border border-berry/30 bg-berry/10 px-5 py-3 text-sm font-medium text-berry-dark"
        >
            {{ error }}
        </p>
    </div>
</template>
