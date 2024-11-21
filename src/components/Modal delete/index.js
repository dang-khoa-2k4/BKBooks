import React from 'react';
import { Modal, Box, Typography, Button, IconButton } from '@mui/material';
import DeleteIcon from '@mui/icons-material/Delete';

const style = {
  position: 'absolute',
  top: '50%',
  left: '50%',
  transform: 'translate(-50%, -50%)',
  width: 400,
  bgcolor: 'background.paper',
  boxShadow: 24,
  p: 4,
  borderRadius: 2,
  textAlign: 'center'
};

export default function DeleteModal({ open, onClose, onDelete }) {
  return (
    <Modal
      open={open}
      onClose={onClose}
      aria-labelledby="modal-delete-title"
      aria-describedby="modal-delete-description"
    >
      <Box sx={style}>
        {/* Icon và Tiêu đề */}
        <Box display="flex" alignItems="center" justifyContent="center" mb={2}>
          <IconButton color="error" disableRipple sx={{ mr: 1 }}>
            <DeleteIcon fontSize="large" />
          </IconButton>
          <Typography id="modal-delete-title" variant="h6">
            Bạn có chắc muốn xóa?
          </Typography>
        </Box>

        {/* Các nút Hủy và Xóa */}
        <Box display="flex" justifyContent="space-between" mt={2}>
          <Button variant="outlined" onClick={onClose} sx={{ width: '45%' }}>
            Hủy
          </Button>
          <Button
            variant="contained"
            color="error"
            onClick={onDelete}
            sx={{ width: '45%' }}
          >
            Xóa
          </Button>
        </Box>
      </Box>
    </Modal>
  );
}
