<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import AdminLayout from '@/layouts/AdminLayout.vue';

defineOptions({ layout: AdminLayout });
</script>

<template>
    <Head title="Administration" />

    <h1 class="font-display text-3xl font-bold text-bark">Tableau de bord</h1>
    <p class="mt-2 text-bark-soft">
        Les catégories, les cadeaux et les statistiques arrivent ici.
    </p>
</template>
