
-- add new columns
ALTER TABLE transaction_verification
ADD new_column1 VARCHAR(255) NULL DEFAULT NULL,
ADD new_column2 VARCHAR(255) NULL DEFAULT NULL
AFTER remarks_tech_issues;


-- table operational_details
ALTER TABLE operational_details MODIFY abe_name VARCHAR(100) NULL DEFAULT NULL;
ALTER TABLE operational_details MODIFY abm_name VARCHAR(100) NULL DEFAULT NULL;
ALTER TABLE operational_details MODIFY rm_name VARCHAR(100) NULL DEFAULT NULL;
ALTER TABLE operational_details MODIFY zm_name VARCHAR(100) NULL DEFAULT NULL;
ALTER TABLE operational_details MODIFY operating_hours VARCHAR(250) NULL DEFAULT NULL;
ALTER TABLE operational_details MODIFY designated_location VARCHAR(10) NULL DEFAULT NULL;
ALTER TABLE operational_details MODIFY designated_location_remarks VARCHAR(250) NULL DEFAULT NULL;
ALTER TABLE operational_details MODIFY training_given VARCHAR(10) NULL DEFAULT NULL;
ALTER TABLE operational_details MODIFY training_remarks VARCHAR(250) NULL DEFAULT NULL;
ALTER TABLE operational_details MODIFY business_explore VARCHAR(10) NULL DEFAULT NULL;
ALTER TABLE operational_details MODIFY business_explore_remarks VARCHAR(250) NULL DEFAULT NULL;
ALTER TABLE operational_details MODIFY target_set VARCHAR(10) NULL DEFAULT NULL;
ALTER TABLE operational_details MODIFY target_clear VARCHAR(10) NULL DEFAULT NULL;
ALTER TABLE operational_details MODIFY target_documented VARCHAR(10) NULL DEFAULT NULL;
ALTER TABLE operational_details MODIFY abe_support VARCHAR(10) NULL DEFAULT NULL;
ALTER TABLE operational_details MODIFY bank_support VARCHAR(10) NULL DEFAULT NULL;
ALTER TABLE operational_details MODIFY target_remarks VARCHAR(250) NULL DEFAULT NULL;
ALTER TABLE operational_details MODIFY onboarding_fee_paid VARCHAR(10) NULL DEFAULT NULL;
ALTER TABLE operational_details MODIFY fee_unclear VARCHAR(10) NULL DEFAULT NULL;
ALTER TABLE operational_details MODIFY fees_documented VARCHAR(10) NULL DEFAULT NULL;
ALTER TABLE operational_details MODIFY fee_payment_mode VARCHAR(20) NULL DEFAULT NULL;
ALTER TABLE operational_details MODIFY onboarding_remarks VARCHAR(250) NULL DEFAULT NULL;
ALTER TABLE operational_details MODIFY rm_visit VARCHAR(10) NULL DEFAULT NULL;
ALTER TABLE operational_details MODIFY rm_visit_remarks VARCHAR(250) NULL DEFAULT NULL;
ALTER TABLE operational_details MODIFY abm_visit VARCHAR(10) NULL DEFAULT NULL;
ALTER TABLE operational_details MODIFY abm_visit_remarks VARCHAR(250) NULL DEFAULT NULL;
ALTER TABLE operational_details MODIFY abe_visit VARCHAR(10) NULL DEFAULT NULL;
ALTER TABLE operational_details MODIFY abe_visit_remarks VARCHAR(250) NULL DEFAULT NULL;
ALTER TABLE operational_details MODIFY bank_official_visit VARCHAR(10) NULL DEFAULT NULL;
ALTER TABLE operational_details MODIFY bank_official_visit_remarks VARCHAR(250) NULL DEFAULT NULL;
ALTER TABLE operational_details MODIFY bc_visit VARCHAR(10) NULL DEFAULT NULL;
ALTER TABLE operational_details MODIFY bc_visit_remarks VARCHAR(250) NULL DEFAULT NULL;
ALTER TABLE operational_details MODIFY  VARCHAR(20) NULL DEFAULT NULL;
ALTER TABLE operational_details MODIFY  DATETIME NULL DEFAULT NULL;






-- table register_maintain

ALTER TABLE register_maintain
MODIFY COLUMN audit_number VARCHAR(255) DEFAULT NULL,
MODIFY COLUMN transaction_register VARCHAR(255) DEFAULT NULL,
MODIFY COLUMN transaction_register_remarks VARCHAR(255) DEFAULT NULL,
MODIFY COLUMN account_opening_register VARCHAR(255) DEFAULT NULL,
MODIFY COLUMN account_opening_register_remarks VARCHAR(255) DEFAULT NULL,
MODIFY COLUMN complaint_register VARCHAR(255) DEFAULT NULL,
MODIFY COLUMN complaint_register_remarks VARCHAR(255) DEFAULT NULL,
MODIFY COLUMN visitor_register VARCHAR(255) DEFAULT NULL,
MODIFY COLUMN visitor_register_remarks VARCHAR(255) DEFAULT NULL,
MODIFY COLUMN cash_register VARCHAR(255) DEFAULT NULL,
MODIFY COLUMN cash_register_remarks VARCHAR(255) DEFAULT NULL,
MODIFY COLUMN audit_register VARCHAR(255) DEFAULT NULL,
MODIFY COLUMN audit_register_remarks VARCHAR(255) DEFAULT NULL,
MODIFY COLUMN service_register VARCHAR(255) DEFAULT NULL,
MODIFY COLUMN service_register_remarks VARCHAR(255) DEFAULT NULL,
MODIFY COLUMN inventory_register VARCHAR(255) DEFAULT NULL,
MODIFY COLUMN inventory_register_remarks VARCHAR(255) DEFAULT NULL,
MODIFY COLUMN loan_register VARCHAR(255) DEFAULT NULL,
MODIFY COLUMN loan_register_remarks VARCHAR(255) DEFAULT NULL,
MODIFY COLUMN customer_feedback_register VARCHAR(255) DEFAULT NULL,
MODIFY COLUMN customer_feedback_register_remarks VARCHAR(255) DEFAULT NULL,
MODIFY COLUMN compliance_register VARCHAR(255) DEFAULT NULL,
MODIFY COLUMN compliance_register_remarks VARCHAR(255) DEFAULT NULL,
MODIFY COLUMN staff_attendance_register VARCHAR(255) DEFAULT NULL,
MODIFY COLUMN staff_attendance_register_remarks TEXT DEFAULT NULL,
MODIFY COLUMN training_register ENUM('Yes','No') DEFAULT NULL,
MODIFY COLUMN training_register_remarks TEXT DEFAULT NULL,
MODIFY COLUMN shg_register ENUM('Yes','No') DEFAULT NULL,
MODIFY COLUMN shg_register_remarks TEXT DEFAULT NULL,
MODIFY COLUMN settlement_register ENUM('Yes','No') DEFAULT NULL,
MODIFY COLUMN settlement_register_remarks TEXT DEFAULT NULL,
MODIFY COLUMN target_achievement_register ENUM('Yes','No') DEFAULT NULL,
MODIFY COLUMN target_achievement_register_remarks TEXT DEFAULT NULL,
MODIFY COLUMN entries_accuracy ENUM('Yes','No') DEFAULT NULL,
MODIFY COLUMN entries_accuracy_remarks TEXT DEFAULT NULL,
MODIFY COLUMN transaction_entries_reliability ENUM('Yes','No') DEFAULT NULL,
MODIFY COLUMN transaction_entries_reliability_remarks TEXT DEFAULT NULL,
MODIFY COLUMN txn_count_matching ENUM('Yes','No') DEFAULT NULL,
MODIFY COLUMN txn_count_matching_remarks TEXT DEFAULT NULL,
MODIFY COLUMN additional_remarks_registers TEXT DEFAULT NULL;


-- table compliance_verification

ALTER TABLE compliance_verification MODIFY audit_number VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE compliance_verification MODIFY bc_point_place VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE compliance_verification MODIFY bc_point_place_remarks VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE compliance_verification MODIFY bc_point_clean VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE compliance_verification MODIFY bc_point_clean_remarks VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE compliance_verification MODIFY posters_displayed VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE compliance_verification MODIFY outdated_posters VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE compliance_verification MODIFY posters_remarks VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE compliance_verification MODIFY customer_alert_dos_donts VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE compliance_verification MODIFY customer_alert_dos_donts_remarks VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE compliance_verification MODIFY verification_certificate VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE compliance_verification MODIFY verification_certificate_remarks VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE compliance_verification MODIFY unauthorized_individuals VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE compliance_verification MODIFY unauthorized_individuals_remarks VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE compliance_verification MODIFY id_card_usage VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE compliance_verification MODIFY id_card_usage_remarks VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE compliance_verification MODIFY clone_fingerprint VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE compliance_verification MODIFY clone_fingerprint_remarks VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE compliance_verification MODIFY manual_receipts VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE compliance_verification MODIFY system_generated_receipts VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE compliance_verification MODIFY customer_passbooks VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE compliance_verification MODIFY transaction_slips VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE compliance_verification MODIFY manual_receipts_remarks VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE compliance_verification MODIFY non_relevant_applications VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE compliance_verification MODIFY blocked_accounts VARCHAR(255) NULL DEFAULT NULL;


-- table transaction_verification

ALTER TABLE transaction_verification
MODIFY COLUMN audit_number VARCHAR(255) DEFAULT NULL,
MODIFY COLUMN proc_trans VARCHAR(255) DEFAULT NULL,
MODIFY COLUMN remarks_proc_trans VARCHAR(255) DEFAULT NULL,
MODIFY COLUMN proc_dep_with VARCHAR(255) DEFAULT NULL,
MODIFY COLUMN remarks_proc_dep_with VARCHAR(255) DEFAULT NULL,
MODIFY COLUMN delay_trans VARCHAR(255) DEFAULT NULL,
MODIFY COLUMN remarks_delay_trans VARCHAR(255) DEFAULT NULL,
MODIFY COLUMN acc_trans VARCHAR(255) DEFAULT NULL,
MODIFY COLUMN remarks_acc_trans VARCHAR(255) DEFAULT NULL,
MODIFY COLUMN time_match VARCHAR(255) DEFAULT NULL,
MODIFY COLUMN remarks_time_match VARCHAR(255) DEFAULT NULL,
MODIFY COLUMN cust_ver VARCHAR(255) DEFAULT NULL,
MODIFY COLUMN remarks_cust_ver VARCHAR(255) DEFAULT NULL,
MODIFY COLUMN bc_verify VARCHAR(255) DEFAULT NULL,
MODIFY COLUMN remarks_bc_verify VARCHAR(255) DEFAULT NULL,
MODIFY COLUMN sys_receipts VARCHAR(255) DEFAULT NULL,
MODIFY COLUMN remarks_sys_receipts VARCHAR(255) DEFAULT NULL,
MODIFY COLUMN cust_copy VARCHAR(255) DEFAULT NULL,
MODIFY COLUMN remarks_cust_copy VARCHAR(255) DEFAULT NULL,
MODIFY COLUMN presc_limits VARCHAR(255) DEFAULT NULL,
MODIFY COLUMN remarks_presc_limits VARCHAR(255) DEFAULT NULL,
MODIFY COLUMN auth_trans VARCHAR(255) DEFAULT NULL,
MODIFY COLUMN remarks_auth_trans VARCHAR(255) DEFAULT NULL,
MODIFY COLUMN cash_handling VARCHAR(255) DEFAULT NULL,
MODIFY COLUMN remarks_cash_handling VARCHAR(255) DEFAULT NULL,
MODIFY COLUMN cash_discrep ENUM('Yes','No') DEFAULT NULL,
MODIFY COLUMN remarks_cash_discrep VARCHAR(255) DEFAULT NULL,
MODIFY COLUMN complaints ENUM('Yes','No') DEFAULT NULL,
MODIFY COLUMN remarks_complaints VARCHAR(255) DEFAULT NULL,
MODIFY COLUMN comp_policies ENUM('Yes','No') DEFAULT NULL,
MODIFY COLUMN remarks_comp_policies VARCHAR(255) DEFAULT NULL,
MODIFY COLUMN reg_req ENUM('Yes','No') DEFAULT NULL,
MODIFY COLUMN remarks_reg_req VARCHAR(255) DEFAULT NULL,
MODIFY COLUMN audit_trail ENUM('Yes','No') DEFAULT NULL,
MODIFY COLUMN remarks_audit_trail VARCHAR(255) DEFAULT NULL,
MODIFY COLUMN comm_trans ENUM('Yes','No') DEFAULT NULL,
MODIFY COLUMN remarks_comm_trans VARCHAR(255) DEFAULT NULL,
MODIFY COLUMN tech_issues ENUM('Yes','No') DEFAULT NULL,
MODIFY COLUMN remarks_tech_issues VARCHAR(255) DEFAULT NULL,


-- Add columns in transaction_verification
ALTER TABLE transaction_verification
ADD maintain_shg VARCHAR(255) NULL DEFAULT NULL AFTER remarks_tech_issues,
ADD mentor_groups VARCHAR(255) NULL DEFAULT NULL AFTER maintain_shg,
ADD groups_maintain VARCHAR(255) NULL DEFAULT NULL AFTER mentor_groups,
ADD book_keeping VARCHAR(255) NULL DEFAULT NULL AFTER groups_maintain,
ADD shg_activity_remarks VARCHAR(255) NULL DEFAULT NULL AFTER book_keeping;


-- table auditor_observation

ALTER TABLE auditor_observation
MODIFY COLUMN conclusion TEXT DEFAULT NULL,





-- all columns names
SELECT COLUMN_NAME 
FROM INFORMATION_SCHEMA.COLUMNS 
WHERE TABLE_NAME IN (
    'compliance_verification', 
    'hardware_infrastructure', 
    'operational_details', 
    'register_maintain', 
    'transaction_verification'
);


bc_point_place
bc_point_place_remarks
bc_point_clean
bc_point_clean_remarks
posters_displayed
outdated_posters
posters_remarks
customer_alert_dos_donts
customer_alert_dos_donts_remarks
verification_certificate
verification_certificate_remarks
unauthorized_individuals
unauthorized_individuals_remarks
id_card_usage
id_card_usage_remarks
clone_fingerprint
clone_fingerprint_remarks
manual_receipts
system_generated_receipts
customer_passbooks
transaction_slips
manual_receipts_remarks
non_relevant_applications
non_relevant_applications_remarks
blocked_accounts
blocked_accounts_remarks


laptop_desktop
laptop_desktop_remarks
printer
printer_remarks
scanner
scanner_remarks
biometric
biometric_remarks
pos_terminal
pos_terminal_remarks
internet_router
internet_router_remarks
ups
ups_remarks
cctv_camera
cctv_camera_remarks
mobile_tablet
mobile_tablet_remarks
counting_machine
counting_machine_remarks
card_reader
card_reader_remarks
external_hdd
external_hdd_remarks
photocopier
photocopier_remarks
other_devices
hardware_photo_path
hardware_remarks


operating_hours
designated_location
designated_location_remarks
training_given
training_remarks
business_explore
business_explore_remarks
target_set
target_clear
target_documented
abe_support
bank_support
target_remarks
onboarding_fee_paid
fee_unclear
fees_documented
fee_payment_mode
onboarding_remarks
rm_visit
rm_visit_remarks
abm_visit
abm_visit_remarks
abe_visit
abe_visit_remarks
bank_official_visit
bank_official_visit_remarks
bc_visit
bc_visit_remarks


transaction_register
transaction_register_remarks
account_opening_register
account_opening_register_remarks
complaint_register
complaint_register_remarks
visitor_register
visitor_register_remarks
cash_register
cash_register_remarks
audit_register
audit_register_remarks
service_register
service_register_remarks
inventory_register
inventory_register_remarks
loan_register
loan_register_remarks
customer_feedback_register
customer_feedback_register_remarks
compliance_register
compliance_register_remarks
staff_attendance_register
staff_attendance_register_remarks
training_register
training_register_remarks
shg_register
shg_register_remarks
settlement_register
settlement_register_remarks
target_achievement_register
target_achievement_register_remarks
entries_accuracy
entries_accuracy_remarks
transaction_entries_reliability
transaction_entries_reliability_remarks
txn_count_matching
txn_count_matching_remarks
additional_remarks_registers


proc_trans
remarks_proc_trans
proc_dep_with
remarks_proc_dep_with
delay_trans
remarks_delay_trans
acc_trans
remarks_acc_trans
time_match
remarks_time_match
cust_ver
remarks_cust_ver
bc_verify
remarks_bc_verify
sys_receipts
remarks_sys_receipts
cust_copy
remarks_cust_copy
presc_limits
remarks_presc_limits
auth_trans
remarks_auth_trans
cash_handling
remarks_cash_handling
cash_discrep
remarks_cash_discrep
complaints
remarks_complaints
comp_policies
remarks_comp_policies
reg_req
remarks_reg_req
audit_trail
remarks_audit_trail
comm_trans
remarks_comm_trans
tech_issues
remarks_tech_issues
maintain_shg
mentor_groups
groups_maintain
book_keeping
shg_activity_remarks



