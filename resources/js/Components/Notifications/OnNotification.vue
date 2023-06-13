<script setup lang="ts">
import { NotificationGroup } from 'notiwind'

import { NotifyGroupId } from '@/Composables/useNotification'

import OnNotificationDefault from '@/Components/Notifications/OnNotificationDefault.vue'
import OnNotificationFailed from '@/Components/Notifications/OnNotificationFailed.vue'
import OnNotificationWarning from '@/Components/Notifications/OnNotificationWarning.vue'
import OnNotificationSuccess from '@/Components/Notifications/OnNotificationSuccess.vue'
</script>

<template>
    <div>
        <NotificationGroup :group="NotifyGroupId.Info">
            <div class="fixed inset-0 flex items-start justify-end px-4 py-6 mt-28 pointer-events-none">
                <div class="w-full max-w-sm">
                    <OnNotificationDefault />
                </div>
            </div>
        </NotificationGroup>

        <NotificationGroup :group="NotifyGroupId.Success">
            <div class="fixed inset-0 flex items-start justify-end px-4 py-6 mt-28 pointer-events-none">
                <div class="w-full max-w-sm">
                    <OnNotificationSuccess />
                </div>
            </div>
        </NotificationGroup>

        <NotificationGroup :group="NotifyGroupId.Warning">
            <div class="fixed inset-0 flex items-start justify-end px-4 py-6 mt-28 pointer-events-none">
                <div class="w-full max-w-sm">
                    <OnNotificationWarning />
                </div>
            </div>
        </NotificationGroup>

        <NotificationGroup :group="NotifyGroupId.Failed">
            <div class="fixed inset-0 flex items-start justify-end px-4 py-6 mt-28 pointer-events-none">
                <div class="w-full max-w-sm">
                    <OnNotificationFailed />
                </div>
            </div>
        </NotificationGroup>
    </div>
</template>
