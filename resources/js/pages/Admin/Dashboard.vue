<script setup lang="ts">
import { Head, Link, usePage } from '@inertiajs/vue3';
import { logout } from '@/routes/admin';

const page = usePage();
</script>

<template>
    <main class="min-h-screen p-8">
        <Head title="Administration" />

        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-semibold">Administration</h1>
            <Link
                :href="logout()"
                method="post"
                as="button"
                class="text-sm text-red-700 underline"
                >Déconnexion</Link
            >
        </div>

        <p class="mt-2 text-sm text-gray-500">
            Connecté en tant que {{ page.props.auth.admin?.login }}.
        </p>
    </main>
</template>
